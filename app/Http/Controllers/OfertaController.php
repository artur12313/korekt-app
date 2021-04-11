<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Klient;
use App\Zamowienie;
class OfertaController extends Controller
{
    public function index()
    {
        $klienci = Klient::all();
        return view('oferta')->with(['klienci' => $klienci]);
    }

    public function show($id)
    {
        $klient = Klient::find($id);
        return view('oferta-show')->with(['klient' => $klient]);
    }
}
