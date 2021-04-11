<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Klient;

class KlientController extends Controller
{
    public function index()
    {
        $klienci = Klient::all();
        return view('klienci')->with(['klienci' => $klienci]);
    }

    public function create()
    {
        return view('klienci-new');
    }

    public function show($id)
    {
        $klient = Klient::find($id);
        return view('klienci-show')->with(['klient' => $klient]);
    }

    public function edit($id)
    {
        $klient = Klient::find($id);
        return view('klienci-edit')->with(['klient' => $klient]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nazwa' => 'required|string|max:255',
        ]);

        $klient = Klient::find($id);
        $klient->nazwa = $request->nazwa;
        $klient->miejscowosc = $request->miejscowosc;
        $klient->adres = $request->adres;
        $klient->tel = $request->tel;
        $klient->dotyczy = $request->dotyczy;
        $klient->zakres = $request->zakres;
        $klient->update();

        return redirect('/klienci')->with('success','Pomyślnie zmodyfikowano klienta');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nazwa' => 'required|string|max:255',
        ]);

        $klient = new Klient;
        $klient->nazwa = $request->nazwa;
        $klient->miejscowosc = $request->miejscowosc;
        $klient->adres = $request->adres;
        $klient->tel = $request->tel;
        $klient->author_id = auth()->user()->id;
        $klient->dotyczy = $request->dotyczy;
        $klient->zakres = $request->zakres;
        $klient->save();

        return redirect('/klienci')->with('success', 'Pomyślnie dodany nowy klient');
    }
    
    public function destroy(Request $request, $id) 
    {
        $klient = Klient::find($id);
        $klient->zamowienia()->delete();
        Klient::destroy($id);
        return redirect('/klienci')->with('success','Pomyślnie usunięto klienta');
    }
}
