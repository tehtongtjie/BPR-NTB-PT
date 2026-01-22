<?php

namespace App\Http\Controllers;

class DepositoController extends Controller
{
    /**
     * Redirect ke deposito default
     */
    public function index()
    {
        return redirect()->route(
            'deposito.show',
            'deposito-berjangka'
        );
    }

    /**
     * Tampilkan detail deposito
     */
    public function show($slug)
    {
        $deposito = config("deposito.$slug");

        if (!$deposito) {
            abort(404);
        }

        return view('pages.deposito.show', compact('deposito'));
    }
}
