<?php

namespace App\Http\Controllers;

class DepositoController extends Controller
{
    public function index()
    {
        return redirect()->route(
            'deposito.show',
            'deposito-berjangka'
        );
    }

    public function show($slug)
    {
        $deposito = config("deposito.$slug");

        if (!$deposito) {
            abort(404);
        }

        return view('user.pages.deposito.show', compact('deposito'));
    }
}
