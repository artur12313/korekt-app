<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pracownik;
use App\Zadania;
use App\Klient;
use App\Rozliczenia;
class ZadaniaController extends Controller
{
    public function index($id)
    {
        $zadania = Zadania::find($id);
        $rozliczenia = Rozliczenia::find($id);
        return view('zadania')->with(['zadania' => $zadania, 'rozliczenia' => $rozliczenia]);
    }

    public function create(Request $request, $id)
    {
        $rozliczenia = Rozliczenia::find($id);
        $klienci = Klient::all();
        return view('zadania-new')->with([ 'klienci' => $klienci, 'rozliczenia' => $rozliczenia]);
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'opis' => 'required|string|max:255'
        ]);
            $rozliczenia = Rozliczenia::find($id);
        
        $zadania = new Zadania;
        $zadania->opis = $request->opis;
        $zadania->data = $request->data;
        $zadania->client_id = $request->klient;
        $zadania->author_id = auth()->user()->id;
        $zadania->save();
        $zadania->rozliczenia()->attach($rozliczenia->id, ['czas' => $request->czas, 'stawka' => $request->stawka]);
        $zadania->save();

        return redirect("/zadania/$rozliczenia->id")->with('success', 'Pomyślnie dodano zadanie');
    }

    public function destroy(Request $request, $id)
    {
        $zadania = Zadania::find($id);
        $zadania->delete();
        return redirect("/pracownicy")->with('success', 'Pomyślnie usunięto zadanie');
    }
}
