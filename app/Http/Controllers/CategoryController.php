<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories')->with(['categories' => $categories]);
    }

    public function create()
    {
        return view('categories-new');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('categories-show')->with(['category' => $category]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories-edit')->with(['category' => $category]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect('/kategorie')->with('success','Pomyślnie dodano kategorię');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->update();

        return redirect('/kategorie')->with('success','Pomyślnie zmodyfikowano kategorię');
    }

    public function destroy(Request $request, $id) 
    {
        Category::destroy($id);
        return redirect('/kategorie')->with('success','Pomyślnie usunięto kategorię');
    }

    public function archiwum()
    {
        $category = Category::onlyTrashed()->get();
        return view('archiwum-categories')->with(['categories' => $category->sortByDesc('updated_at')]);
    }

    public function archiwum_old_products($id)
    {
        $category = Category::onlyTrashed()->find($id);
        return view('categories-show-archiwum')->with(['category' => $category]);
    }

    public function forceDelete(Request $request, $id) 
    {
        $category = Category::onlyTrashed()->find($id);
        $category->forceDelete();

        return redirect('/kategorie-archiwum')->with('success','Pomyślnie usunięto kategorię');
    }

}
