<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zamowienie;
use App\Klient;

class ZamowienieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $zamowienia = Zamowienie::all();
        return view('zamowienia')->with(['zamowienia' => $zamowienia->sortByDesc('updated_at')]);
    }

    public function store(Request $request)
    {
        $zamowienie = new Zamowienie;
        $zamowienie->save();

        return redirect('/zamowienia')->with('success','Pomyślnie dodano nowe zamówienie');
    }

    public function create()
    {
        $klienci = Klient::all();
        return view('zamowienia-create')->with(['klienci' => $klienci]);
    }

    public function show($id)
    {
        $zamowienie = Zamowienie::find($id);
        return view('zamowienia-show')->with(['zamowienie' => $zamowienie]);
    }

    public function edit($id)
    {
        $zamowienia = Zamowienie::with('products', 'client')->find($id);
        $klienci = Klient::all();
        return view('zamowienia-edit')->with(['zamowienia' => $zamowienia, 'klienci' => $klienci]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'products.*.ilosc' => 'required',
            'products.*.marza' => 'required',
        ]);

        $zamowienie = Zamowienie::find($id);
        $product_ids = [];
        foreach($request->products as $product)
        {
            if($product['ilosc'] > 0) {
                $product_ids[$product['id']] = ['ilosc' => $product['ilosc'], 'marza' => $product['marza']];
            }
        }
        
        $zamowienie->products()->sync($product_ids, true);
        $zamowienie->touch();
        $zamowienie->update();

        return view('zamowienia-show')->with(['zamowienie' => $zamowienie, 'success' => 'Pomyślnie zaktualizowano ilość oraz marżę']);
    }

    public function destroy(Request $request, $id)
    {
        $zamowienie = Zamowienie::find($id);
        $zamowienie->delete();
        return redirect('/zamowienia')->with('success','Pomyślnie usunięto zamówienie');
    }
}
