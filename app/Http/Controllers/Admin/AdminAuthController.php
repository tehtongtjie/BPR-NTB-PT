<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // <-- 1. Tambahkan ini

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin) {
            return back()->withErrors(['username' => 'Username tidak ditemukan']);
        }

        if (!$admin->is_active) {
            return back()->withErrors(['username' => 'Akun admin tidak aktif']);
        }

        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['password' => 'Password salah']);
        }

        // 2. KUNCI UTAMA: Login-kan admin ke sistem Laravel
        Auth::login($admin);

        // (Opsional) Tetap simpan session lama kamu jika masih dipakai di tempat lain
        session([
            'admin_logged_in' => true,
            'admin_id'       => $admin->id,
            'admin_username' => $admin->username,
        ]);

        $admin->update(['last_login_at' => now()]);

        // Tentukan arah
        $path = match ($admin->role) {
            'it', 'sekper' => '/admin/main',
            'bisnis'       => '/admin/umkms',
            default        => '/admin/main',
        };

        // Gunakan ->to() agar bersih dari history redirect sebelumnya
        session()->forget('url.intended');
        return redirect()->to($path);
    }
}
