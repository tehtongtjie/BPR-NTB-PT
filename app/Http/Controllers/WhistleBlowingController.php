<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhistleBlowingController extends Controller
{
    /**
     * Menampilkan halaman form WBS.
     */
    public function index()
    {
        // Pastikan path folder 'pengaduan' sudah sesuai dengan di VS Code kamu
        return view('pages.pengaduan.WhistleBlowingSystem');
    }

    /**
     * Memproses pengiriman laporan dan foto ke Telegram.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Server-side)
        // Foto dibatasi maksimal 2048 KB (2MB)
        $request->validate([
            'kategori' => 'required',
            'terlapor' => 'required',
            'lokasi'   => 'required',
            'laporan'  => 'required|min:10',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Konfigurasi Telegram (Gunakan variabel yang sudah kita validasi tadi)
        $token  = "8562446265:AAEyeWn4KxUfIREc5ZQMDJlb547qL_2gLX0";
        $chatID = "-1003814929066";

        // 3. Susun Pesan Markdown
        $pesan = "🚨 *LAPORAN WBS BARU*\n"
            . "━━━━━━━━━━━━━━━━━━━━\n"
            . "👤 *Pelapor:* " . ($request->nama ?: 'Anonim') . "\n"
            . "📁 *Kategori:* " . $request->kategori . "\n"
            . "👤 *Terlapor:* " . $request->terlapor . "\n"
            . "📍 *Lokasi:* " . $request->lokasi . "\n"
            . "━━━━━━━━━━━━━━━━━━━━\n"
            . "📝 *Isi Laporan:*\n" . $request->laporan . "\n"
            . "━━━━━━━━━━━━━━━━━━━━\n"
            . "📅 _Waktu: " . now()->format('d M Y, H:i') . " WITA_";

        try {
            if ($request->hasFile('foto')) {
                // KIRIM FOTO DENGAN CAPTION (Jika user mengunggah bukti)
                $photo = $request->file('foto');

                $response = Http::attach(
                    'photo',
                    file_get_contents($photo),
                    $photo->getClientOriginalName()
                )->post("https://api.telegram.org/bot{$token}/sendPhoto", [
                    'chat_id'    => $chatID,
                    'caption'    => $pesan,
                    'parse_mode' => 'Markdown'
                ]);
            } else {
                // KIRIM PESAN TEKS SAJA (Jika tidak ada foto)
                $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id'    => $chatID,
                    'text'       => $pesan,
                    'parse_mode' => 'Markdown'
                ]);
            }

            // Cek apakah pengiriman ke Telegram berhasil
            if ($response->successful()) {
                return response()->json(['status' => 'success']);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim ke Telegram: ' . $response->reason()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }
}