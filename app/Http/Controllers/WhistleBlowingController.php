<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WhistleBlowingController extends Controller
{
    public function index()
    {
        return view('user.pages.pengaduan.WhistleBlowingSystem');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'kategori' => 'required',
            'terlapor' => 'required',
            'lokasi'   => 'required',
            'laporan'  => 'required|min:10',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Data Laporan
        $data = [
            'nama'     => $request->nama ?: 'Anonim',
            'kategori' => $request->kategori,
            'terlapor' => $request->terlapor,
            'lokasi'   => $request->lokasi,
            'laporan'  => $request->laporan,
            'waktu'    => now()->setTimezone('Asia/Makassar')->format('d M Y, H:i') . " WITA",
        ];

        try {
            // 3. Kirim Email menggunakan Mail::send
            Mail::send([], [], function ($message) use ($data, $request) {
                // Email tujuan (Email Admin/Internal Audit BPR)
                $message->to('lalurfqi@gmail.com')
                    ->subject('🚨 LAPORAN WBS BARU - ' . $data['kategori'])
                    ->html("
                            <div style='font-family: sans-serif; line-height: 1.6;'>
                                <h2>Laporan Whistle Blowing System</h2>
                                <hr>
                                <p><strong>Pelapor:</strong> {$data['nama']}</p>
                                <p><strong>Kategori:</strong> {$data['kategori']}</p>
                                <p><strong>Terlapor:</strong> {$data['terlapor']}</p>
                                <p><strong>Lokasi Kejadian:</strong> {$data['lokasi']}</p>
                                <br>
                                <p><strong>Isi Laporan:</strong></p>
                                <div style='background: #f4f4f4; padding: 15px; border-radius: 5px;'>
                                    " . nl2br(e($data['laporan'])) . "
                                </div>
                                <br>
                                <small>Laporan diterima pada: {$data['waktu']}</small>
                            </div>
                        ");

                // Lampirkan foto jika ada
                if ($request->hasFile('foto')) {
                    $message->attach($request->file('foto')->getRealPath(), [
                        'as' => 'Bukti_Laporan_' . time() . '.' . $request->file('foto')->getClientOriginalExtension(),
                        'mime' => $request->file('foto')->getMimeType(),
                    ]);
                }
            });

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim email: ' . $e->getMessage()
            ], 500);
        }
    }
}