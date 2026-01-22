<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = config('umkm.mitra');

        abort_if(!$umkms, 404);

        return view('users.umkm.mitra', compact('umkms'));
    }
}
