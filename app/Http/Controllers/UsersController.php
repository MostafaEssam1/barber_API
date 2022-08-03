<?php

namespace App\Http\Controllers;

use App\users;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $allUsers = users::all();
        return $allUsers;
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'=> 'required|string',
            'age'=> 'required',
            'email'=> 'required|unique:users,email',
            'password'=> 'required|string|confirmed',
            'address'=> 'required',
            'phone'=> 'required|unique:users,phone'
        ]);

        $user = users::create([
            'name' => $fields['name'],
            'age' => $fields['age'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'address' => $fields['address'],
            'phone' => $fields['phone']
        ]);

        $token = $user->createToken('mobile', ['role:user'])->plainTextToken;

        $response = [
            "User" => $user,
            "token" => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email'=> 'required',
            'password'=> 'required',
        ]);

        $user = users::where("email",$fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                "message" => "bad login"
            ], 404);
        }

        $token = $user->createToken('mobile', ['role:user'])->plainTextToken;

        $response = [
            "User" => $user,
            "token" => $token,
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return[
            "message" => "logout Successfully",
        ];
    }

    public function show($id)
    {
        return users::find($id);
    }


    public function update(Request $request, $id)
    {
        $users = users::find($id);

        $request->validate([
            'name'=> 'required',
            'age'=> 'required',
            'email'=> 'required',
            'password'=> 'required',
            'address'=> 'required',
            'phone'=> 'required'
        ]);

        $users->update($request->all());

        return $users;
    }

    public function destroy($id)
    {
        return users::destroy($id);
    }
}
