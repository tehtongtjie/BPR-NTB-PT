<?php

namespace App\Http\Controllers;

use App\Models\RiplayDocument;
use Illuminate\Http\Request;

class RiplayController extends Controller
{
    public function index()
    {
        $documents = RiplayDocument::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pages.riplay.index', compact('documents'));
    }
}
