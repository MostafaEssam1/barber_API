<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $allCategories = category::all();
        return $allCategories;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);

        return category::create($request->all());
    }


    public function show($id)
    {
        return category::find($id);
    }

    public function update(Request $request, $id)
    {
        $category = category::find($id);

        $request->validate([
            'name' => "required",
        ]);

        $category->update($request->all());

        return $category;
    }


    public function destroy($id)
    {
        return category::destroy($id);
    }
}
