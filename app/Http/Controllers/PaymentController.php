<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(){
        return view("template",[
            'page_title' => 'All Payments',
            'active' => 'payment',
            'heading' => 'All Payments',
            // 'flat' => $flat,
        ]);
    }

    public function create(Request $request){
        $flat = \App\Flat::findOrFail(base64_decode($request->id));
        $flat->load(['tenant'=>function($query){
            $query->where('status',\App\Tenant::ACTIVE);
        }]);
        // dd($flat);

        return view("payment.create",[
            'page_title' => 'All Payments',
            'active' => 'payment',
            'heading' => 'All Payments',
            'flat' => $flat,
        ]);
    }

    public function store(Request $request){
        // dd($request);
        $this->validate($request,[
            'amount' => 'required|min:1'
        ]);
        $flat = \App\Flat::findOrFail($request->id);
        $flat->load(['tenant'=>function($query){
            $query->where('status',\App\Tenant::ACTIVE);
        }]);
        $payment = new \App\Payment();
        $payment->amount = $request->amount;
        $payment->tenant()->associate($flat->tenant)->save();

        $flat->tenant->account->due -= $request->amount;
        $flat->tenant->account->save();

        return redirect()->route('flats.details',$flat);

    }
}
