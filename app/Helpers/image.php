<?php

use Illuminate\Support\Str;

if (!function_exists('public_image_url')) {
    /**
     * Resolve an image path that may reference either the public/images folder or the storage disk.
     *
     * This helper returns the correct asset URL by checking whether the file exists under public/
     * first; otherwise, it falls back to the provided path (usually the storage URL).
     */
    function public_image_url(string $path): string
    {
        $normalized = str_replace('\\', '/', trim($path));

        if ($normalized === '') {
            return asset('');
        }

        $storagePrefix = 'storage/';
        if (str_starts_with($normalized, $storagePrefix)) {
            $relative = ltrim(substr($normalized, strlen($storagePrefix)), '/');

            if ($relative && file_exists(public_path($relative))) {
                return asset($relative);
            }

            $storageFile = storage_path('app/public/' . $relative);
            if ($relative && file_exists($storageFile)) {
                return asset($normalized);
            }
        }

        $candidate = ltrim($normalized, '/');
        if ($candidate && file_exists(public_path($candidate))) {
            return asset($candidate);
        }

        return asset($normalized);
    }
}
