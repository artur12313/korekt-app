<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rozliczenia;

class RozliczeniaController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'opis' => 'required|string|max:255'
        ]);

        $rozliczenia = new Rozliczenia;
        $rozliczenia->opis = $request->opis;
        $rozliczenia->pracownik_id = $request->pracownik_id;
        $rozliczenia->save();

        return redirect("/rozliczenia/{$rozliczenia->pracownik_id}")->with('success','Pomyślnie utworzono nowy okres rozliczeniowy');
    }

    public function destroy(Request $request, $id)
    {
        $rozliczenia = Rozliczenia::find($id);
        $rozliczenia->delete();
        return redirect("/rozliczenia/{$rozliczenia->pracownik_id}")->with('success','Pomyślnie usunięto okres rozliczeniowy pracownika');
    }
}
