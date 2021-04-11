<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pracownik;
use App\Klient;
use App\Rozliczenia;
class PracownicyController extends Controller
{
    public function index()
    {
        $pracownicy = Pracownik::all();
        return view('pracownicy')->with(['pracownicy' => $pracownicy]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'imie' => 'required|string|max:100',
            'nazwisko' => 'required|string|max:150',
        ]);

        $pracownik = new Pracownik;
        $pracownik->imie = $request->imie;
        $pracownik->nazwisko = $request->nazwisko;
        $pracownik->nrkonta = $request->nrkonta;
        $pracownik->tel = $request->tel;
        $pracownik->save();

        return redirect('/pracownicy')->with('success','Pomyślnie dodano pracownika');
    }
    public function destroy(Request $request, $id)
    {
        $pracownik = Pracownik::find($id);
        $pracownik->delete();
        return redirect('/pracownicy')->with('success','Pomyślnie usunięto pracownika');
    }

    public function edit($id)
    {
        $pracownik = Pracownik::find($id);
        return view('pracownicy-edit')->with(['pracownik' =>$pracownik]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'imie' => 'required|string|max:255',
            'nazwisko' => 'required|string|max:255',
        ]);

        $pracownik = Pracownik::find($id);
        $pracownik->imie = $request->imie;
        $pracownik->nazwisko = $request->nazwisko;
        $pracownik->nrkonta = $request->nrkonta;
        $pracownik->tel = $request->tel;
        $pracownik->update();

        return redirect('/pracownicy')->with('success', 'Pomyślnie zmodyfikowano pracownika');
    }

    public function show($id)
    {
        $pracownik = Pracownik::find($id);
        return view('pracownicy-show')->with(['pracownik' => $pracownik]);
    }
}
