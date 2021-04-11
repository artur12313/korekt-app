<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Archiwum;
use App\ArchiwumZam;
use App\Zamowienie;
use App\Klient;
use App\Produkt;
class ArchiwumController extends Controller
{
    public function zamowienia()
    {
        $zamowienia = ArchiwumZam::onlyTrashed()->get();
        return view('zamowienia-archiwum')->with(['zamowienia' => $zamowienia->sortByDesc('updated_at')]);
    }

    public function index()
    {
        $klienci = Archiwum::onlyTrashed()->get();
        return view('archiwum')->with(['klienci' => $klienci]);
    }

    public function show($id)
    {
        $klient = Archiwum::onlyTrashed()->find($id);
        return view('archiwum-show')->with(['klient' => $klient]);
    }
    
    public function zamowienie($id)
    {
        $zamowienie = ArchiwumZam::onlyTrashed()->find($id);
        $zamowienie->products();
        return view('archiwum-zamowienie')->with(['zamowienie' => $zamowienie]);
    }

    public function forceDelete(Request $request, $id) 
    {
        $klient = Archiwum::onlyTrashed()->find($id);
        $klient->forceDelete();
        return redirect('/archiwum')->with('success','Pomyślnie usunięto klienta');
    }

    public function destroy(Request $request, $id)
    {
        $zamowienie = Zamowienie::onlyTrashed()->find($id);
        $zamowienie->forceDelete();
        return redirect('/zamowienia-archiwum')->with('success','Pomyślnie usunięto zamówienie');
    }
    
}