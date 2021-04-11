<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zamowienie;

class OrdersControllerAPI extends Controller
{
    public function store(Request $request)
    {  
        $zamowienie = new Zamowienie;

        $zamowienie->author_id = $request->author_id;
        $zamowienie->client_id = $request->client_id;
        $zamowienie->nazwa = $request->name;
        $zamowienie->labor = $request->labor;
        $zamowienie->vat = $request->vat;
        $zamowienie->save();

        foreach($request->data as $product) {
            if($product['quantity'] > 0) {
                $zamowienie->products()->attach([$product['id'] => ['ilosc' => $product['quantity'], 'marza' => $product['margin']]]); 
            }
        }

        $zamowienie->update();

        return response()->json($zamowienie);
    }

    public function update(Request $request, $id)
    {  
        $zamowienie = Zamowienie::findOrFail($id);

        $product_ids = [];
        $products = $request->data;
        foreach($products as $product) 
        {
            if($product['quantity'] > 0) {
                $product_ids[$product['id']] = ['ilosc' => $product['quantity'], 'marza' => $product['margin']];
            }
        }
        
        $zamowienie->products()->sync($product_ids, true);
        $zamowienie->nazwa = $request->name;
        $zamowienie->vat = $request->vat;
        $zamowienie->labor = $request->labor;
        $zamowienie->touch();
        $zamowienie->update();

        return response()->json($zamowienie);
    }
}
