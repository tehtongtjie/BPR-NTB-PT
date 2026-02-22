<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulasiController extends Controller
{
    public function submit(Request $request)
    {

        $request->validate([
            'nama'     => 'required|string',
            'telepon'  => 'required|string',
            'email'    => 'required|email',
            'jenis'    => 'required|in:deposito,kredit',
        ]);

        if ($request->jenis === 'deposito') {
            return redirect()->route('pages.simulasi.deposito');
        }

        return redirect()->route('user.pages.simulasi.kredit');
    }
}
