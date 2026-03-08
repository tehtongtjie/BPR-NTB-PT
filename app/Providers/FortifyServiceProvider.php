<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse; // <--- 1. Pastikan Import Ini Ada

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        // Halaman login hanya boleh diakses jika token query valid.
        Fortify::loginView(function (Request $request) {
            $token = $request->query('token');
            $validToken = 'abcd';

            if (!$token) {
                abort(404);
            }

            // Jika token masih plain text valid, redirect ke token terenkripsi.
            if (hash_equals($validToken, $token)) {
                return redirect()->route('login', [
                    'token' => Crypt::encryptString($validToken),
                ]);
            }

            try {
                $decodedToken = Crypt::decryptString($token);
            } catch (\Throwable $e) {
                abort(404);
            }

            if (!hash_equals($validToken, $decodedToken)) {
                abort(404);
            }

            return view('admin.auth.login');
        });

        // 2. KUNCI UTAMA: Override LoginResponse agar Redirect Dinamis
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                $user = Auth::user();

                $path = match ($user?->role) {
                    'it', 'sekper' => '/admin/main',
                    'bisnis'       => '/admin/umkms',
                    default        => '/admin/main',
                };

                // Hapus memori URL sebelumnya (intended) supaya tidak nyangkut di /admin/main
                session()->forget('url.intended');

                return redirect()->to($path);
            }
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
