<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class JaringanKantorController extends Controller
{
    public function index(Request $request)
    {

        $semuaKantor = collect(config('jaringan_kantor.kantor'));
        $stats = [
            'total' => $semuaKantor->count(),
            'cabang' => $semuaKantor->filter(fn ($k) =>
                str_contains($k['nama'], 'Kantor Cabang')
            )->count(),
            'kas' => $semuaKantor->filter(fn ($k) =>
                str_contains($k['nama'], 'Kantor Kas')
            )->count(),
        ];

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentItems = $semuaKantor
            ->slice(($currentPage - 1) * $perPage, $perPage)
            ->values();

        $kantor = new LengthAwarePaginator(
            $currentItems,
            $semuaKantor->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('pages.jaringan-kantor.index', [
            'kantor' => $kantor,           
            'semuaKantor' => $semuaKantor, 
            'stats' => $stats,             
        ]);
    }
}
