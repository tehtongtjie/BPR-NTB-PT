<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecommenderController extends Controller
{
    public function index()
    {
        // Data dasar untuk meta title dan icon
        $title = "Asisten Cerdas BPR NTB";
        $icon = "bi-magic";

        return view('user.pages.recommender.index', compact('title', 'icon'));
    }
}
