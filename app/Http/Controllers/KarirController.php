<?php

namespace App\Http\Controllers;

use App\Models\JobRecruit;

class KarirController extends Controller
{
    public function index()
    {
        $jobs = JobRecruit::where('status', 'active')
            ->orderByDesc('is_featured')
            ->orderBy('deadline')
            ->orderBy('title')
            ->get();

        return view('user.pages.karir.index', compact('jobs'));
    }
}
