<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Klient;
use App\Zamowienie;
class SprzedazController extends Controller
{
    public function index()
    {
        $klienci = Klient::all();
        return view('sprzedaz')->with(['klienci' => $klienci]);
    }

    public function show($id)
    {
        $klient = Klient::find($id);
        return view('sprzedaz-show')->with(['klient' => $klient]);
    }

    public function zamowienie($id)
    {
        $zamowienie = Zamowienie::find($id);
        return view('sprzedaz-zamowienie')->with(['zamowienie' => $zamowienie]);
    }

}
