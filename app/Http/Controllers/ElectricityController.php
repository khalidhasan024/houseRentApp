<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flat;
use App\Electricity;
use App\Tenant;

class ElectricityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $flats = Flat::with(['bill:flat_id,unit_bill','electricity'=>function($query){
            $query->where('date',date("Y-m-d H:i:s",strtotime('first day of last month midnight')));
        }])->get();

        // dd($flats[7]->bill->unit_bill);

        return view('electricity.index',[
            'page_title' => 'Electricity Bill',
            'active' => 'electricity',
            'heading' => 'Electricity Bill',
            'flats' => $flats,
        ]);
    }

    public function create(){
        $flats = Flat::all();

        return view('electricity.create',[
            'page_title' => 'Enter Electricity Bill',
            'active' => 'electricity',
            'heading' => 'Enter Electricity Bill',
            'flats' => $flats,
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'end.*' => 'gte:start.*'
        ]);

        $flats = Flat::with(['bill','tenant'=>function($query){
            $query->where('status',Tenant::ACTIVE);
        }])->get();
        // dd($flats[0]->tenant);
        // $flats->load(['tenant.account','bill']);
        // dd($flats);

        foreach ($flats as $flat) {
            $electricity = new Electricity();
            $electricity->date = date('Y-m-d H:i:s', strtotime('first day of '.$request->month.' midnight'));
            $electricity->start_reading = $request->start[$flat->id];
            $electricity->end_reading = $request->end[$flat->id];

            if (isset($flat->tenant)) {
                $flat->tenant->account->due += $flat->bill->rent +
                                                $flat->bill->gas_bill +
                                                $flat->bill->others_bill +
                                                ($flat->bill->unit_bill * ($request->end[$flat->id] - $request->start[$flat->id]));
                $flat->tenant->account->save();
            }

            $electricity->flat()->associate($flat);
            $electricity->save();
        }

        return redirect()->route('electricity.index');
    }

    public function show(Request $request){
        
    }
}
