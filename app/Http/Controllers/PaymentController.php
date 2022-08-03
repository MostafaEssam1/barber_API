<?php

namespace App\Http\Controllers;

use App\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $allPayment = payment::all();
        return $allPayment;
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id'=>"required|numeric",
            'user_id'=> 'required|numeric',
            'data'=> 'required'
        ]);

        return payment::create($request->all());
    }

    public function show(payment $payments)
    {
        return payment::find($id);
    }


    public function update(Request $request, $id)
    {
        $payments = payment::find($id);

        $request->validate([
            'post_id'=>"required",
            'user_id'=> 'required',
            'data'=> 'required'
        ]);
        return $payments;
    }

    public function destroy($id)
    {
        return payment::destroy($id);
    }
}
