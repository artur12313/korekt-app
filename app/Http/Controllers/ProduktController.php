<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produkt;
use App\Category;

class ProduktController extends Controller
{
    public function index()
    {
        $produkty = Produkt::all();
        return view('products')->with(['products' => $produkty]);
    }

    public function create(Request $request)
    {
        $kategorie = Category::all();
        return view('products-new')->with(['kategorie' => $kategorie, 'selectedCategoryId' => $request->category]);
    }

    public function edit($id)
    {
        $produkt = Produkt::find($id);
        $kategorie = Category::all();
        return view('products-edit')->with(['produkt' => $produkt, 'kategorie' => $kategorie]);
        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nazwa' => 'required|string|max:255',
            'jednostka' => 'required|string|max:255',
            'cena_zakupu_netto' => 'required',
            'category_id' => 'required|int'
        ]);

        $produkt = Produkt::find($id);

        $exploded = explode(',', $request->cena_zakupu_netto);
        if(count($exploded) > 1) {
            $produkt->cena_zakupu_netto = $exploded[0] . '.' . $exploded[1];
        } else {
            $produkt->cena_zakupu_netto = $request->cena_zakupu_netto;
        }
        $produkt->update($request->except('cena_zakupu_netto'));

        if($request->selectedCategoryId) {
            return redirect('/kategorie/' . $request->category_id)->with('success','Pomyślnie edytowano produkt');
        }
        return redirect('/kategorie/' . $request->category_id)->with('success','Pomyślnie edytowano produkt');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nazwa' => 'required|string|max:255',
            'jednostka' => 'required|string|max:255',
            'cena_zakupu_netto' => 'required',
            'category_id' => 'required|int'
        ]);
        $produkt = new Produkt;
        $produkt->nazwa = $request->nazwa;
        $produkt->jednostka = $request->jednostka;
        $produkt->dostawca = $request->dostawca;
        $exploded = explode(',', $request->cena_zakupu_netto);
        if(count($exploded) > 1) {
            $produkt->cena_zakupu_netto = $exploded[0] . '.' . $exploded[1];
        } else {
            $produkt->cena_zakupu_netto = $request->cena_zakupu_netto;
        }
        $produkt->category_id = $request->category_id;
        $produkt->save();
        
        if($request->selectedCategoryId) {
            return redirect('/kategorie/' . $request->category_id)->with('success','Pomyślnie dodano nowy produkt');
        }
        return redirect('/kategorie/' . $request->category_id)->with('success','Pomyślnie dodano nowy produkt');
    }

    public function destroy(Request $request, $id) 
    {
        Produkt::destroy($id);
        if($request->selectedCategoryId) {
            return redirect('/products')->with('success','Pomyślnie usunięto produkt');
        }
        return redirect()->back()->with('success', 'Pomyślnie usunięto produkt');
    }

    public function old_index()
    {
        $produkty = Produkt::onlyTrashed()->get();
        return view('archiwum-products')->with(['products' => $produkty]);
    }

    public function forceDelete(Request $request, $id)
    {
        $product = Produkt::onlyTrashed()->find($id);
        $product->forceDelete();
        return redirect('/produkty-archiwum')->with('success', 'Pomyślnie usunięto produkt');
    }
}
