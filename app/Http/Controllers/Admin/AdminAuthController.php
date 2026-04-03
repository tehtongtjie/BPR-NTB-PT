<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $this->ensureIsNotRateLimited($request);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin) {
            RateLimiter::hit($this->throttleKey($request));
            return back()->withErrors(['username' => 'Username tidak ditemukan']);
        }

        if (!$admin->is_active) {
            RateLimiter::hit($this->throttleKey($request));
            return back()->withErrors(['username' => 'Akun admin tidak aktif']);
        }

        if (!Hash::check($request->password, $admin->password)) {
            RateLimiter::hit($this->throttleKey($request));
            return back()->withErrors(['password' => 'Password salah']);
        }

        Auth::login($admin);

        session([
            'admin_logged_in' => true,
            'admin_id'         => $admin->id,
            'admin_username'   => $admin->username,
        ]);

        $admin->update(['last_login_at' => now()]);

        $path = match ($admin->role) {
            'it', 'sekper' => '/admin/main',
            'bisnis'       => '/admin/umkms',
            default        => '/admin/main',
        };

        session()->forget('url.intended');

        RateLimiter::clear($this->throttleKey($request));

        return redirect()->to($path);
    }

    protected function ensureIsNotRateLimited(Request $request)
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            throw ValidationException::withMessages([
                'username' => 'Terlalu banyak percobaan login, silakan coba lagi sebentar.'
            ]);
        }
    }

    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->username) . '|' . $request->ip();
    }
}
