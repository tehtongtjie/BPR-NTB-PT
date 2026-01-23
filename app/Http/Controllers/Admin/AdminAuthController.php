<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            return back()->withErrors([
                'username' => 'Username tidak ditemukan',
            ]);
        }

        if (!$admin->is_active) {
            return back()->withErrors([
                'username' => 'Akun admin tidak aktif',
            ]);
        }

        // INI KUNCI UTAMA
        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors([
                'password' => 'Password salah',
            ]);
        }

        session([
            'admin_logged_in' => true,
            'admin_id'       => $admin->id,
            'admin_username' => $admin->username,
        ]);

        $admin->update([
            'last_login_at' => now(),
        ]);

        return redirect('/admin/main');
    }
}
