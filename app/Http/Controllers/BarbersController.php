<?php

namespace App\Http\Controllers;

use App\barbers;
use App\category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class BarbersController extends Controller
{

    public function index()
    {
        $allBarbers = barbers::all();
        return $allBarbers;
    }


    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'=>'required|string',
            'phone'=> 'required|unique:barbers,phone',
            'address'=> 'required',
            'password'=> 'required|string|confirmed',
            'category_id'=> 'required|numeric'
        ]);

        $barber = barbers::create([
            'name' => $fields['name'],
            'phone' => $fields['phone'],
            'address' => $fields['address'],
            'password' => bcrypt($fields['password']),
            'category_id' => $fields['category_id'],
        ]);

        $token = $barber->createToken('mobile', ['role:barber'])->plainTextToken;

        $response = [
            "User" => $barber,
            "token" => $token,
        ];

        return response($response, 201);
    }


    public function login(Request $request)
    {
        $fields = $request->validate([
            'phone'=> 'required',
            'password'=> 'required',
        ]);

        $barber = barbers::where("email",$fields['email'])->first();

        if(!$barber || !Hash::check($fields['password'], $barber->password)){
            return response([
                "message" => "bad login"
            ], 404);
        }

        $token = $barber->createToken('mobile', ['role:barber'])->plainTextToken;

        $response = [
            "User" => $barber,
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
        return barbers::find($id);
    }

    public function update(Request $request, $id)
    {
        $barber = barbers::find($id);

        $request->validate([
            'name'=>"required",
            'phone'=> 'required',
            'address'=> 'required',
            'password'=> 'required',
            'category_id'=> 'required'
        ]);

        return $barber;
    }

    public function destroy($id)
    {
        return barbers::destroy($id);
    }
}
