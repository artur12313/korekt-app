<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produkt;
use App\Http\Resources\ProductsResource;

class ProductsControllerAPI extends Controller
{
    public function products()
    {
        // produkty, kategorie
        return new ProductsResource(Produkt::all());
    }
}
