<?php

namespace App\Http\Controllers;

use App\barbers;
use App\posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function index()
    {
        $allPosts = posts::all();
        return $allPosts;
    }

    public function store(Request $request)
    {
            $request->validate([
            'price'=>"required",
            'description'=> 'required|string',
            'image'=> 'required',
            'status'=> 'required',
            'barber_id'=> 'required|numeric'
        ]);

        return posts::create($request->all());
    }

    public function show($id)
    {
        return posts::find($id);
    }

    public function update(Request $request, $id)
    {
        $post = posts::find($id);

        $request->validate([
            'price'=>"required",
            'description'=> 'required',
            'image'=> 'required',
            'status'=> 'required',
            'barber_id'=> 'required'
        ]);
        return $post;
    }

    public function destroy($id)
    {
        return posts::destroy($id);
    }
}
