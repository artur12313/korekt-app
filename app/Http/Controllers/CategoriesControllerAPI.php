<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Resources\CategoriesResource;

class CategoriesControllerAPI extends Controller
{  
    public function categories()
    {
        return new CategoriesResource(Category::all());
    }
}
