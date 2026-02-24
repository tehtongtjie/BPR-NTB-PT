<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectTo(
            guests: '/login',
            users: function ($request) {
                // Logic ini dijalankan jika user yang sudah login 
                // tidak sengaja mengakses halaman login lagi
                $user = Auth::user();
                return match ($user?->role) {
                    'it', 'sekper' => '/admin/main',
                    'bisnis'       => '/admin/umkms',
                    default        => '/admin/main',
                };
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
