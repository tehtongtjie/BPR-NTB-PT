<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiplayController extends Controller
{
    public function index()
    {
        $documents = config('riplay.dokumen');
        return view('user.pages.riplay.index', compact('documents'));
    }
}
