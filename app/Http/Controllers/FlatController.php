<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flat;
use App\Bill;
use App\Tenant;
use Faker\Provider\zh_CN\DateTime;

class FlatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flat = Flat::find(8);
        // dd(date('Y-m-d H:i:s',strtotime('first day of this month midnight')));
        // if ($flat->next_tenant->period->date_from == date('Y-m-d H:i:s',strtotime('first day of this month midnight'))) {
        //     dd($flat->next_tenant->period->date_from);
        //     echo '<a href="" class="btn">Update</a>';
        // }
        $flats = Flat::with(
            ['tenant'=>function($query){
                $query->where('status','active');
            }, 
            'next_tenant'=>function($query){
                $query->where('status','next');
            }]
        )->orderBy('name','asc')->get();

        // $flats = Flat::with(['tenant','next_tenant'])->orderBy('name','asc')->paginate(10);
        // dd($flats);
        // dd($flat);
        return view("flats.index",[
            'page_title' => 'All Flats',
            'active' => 'flats',
            'heading' => 'All Flats',
            'flats' => $flats,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("flats.create",[
            'page_title' => 'Add New Flat',
            'active' => 'flats',
            'heading' => 'Add New Flat',
            'values' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validating the data
        $this->validate($request, [
            'flat_name' => 'required|max:25|unique:flats,name',
            'flat_size' => 'required',
        ]);
        // Saving data in database
        $flat = new Flat();
        $bill = new Bill();
        $flat->name = $request->flat_name;
        $flat->size = $request->flat_size;
        $flat->status = Flat::EMPTY;

        $bill->rent = $request->flat_rent;
        $bill->unit_bill = $request->unit_price;
        $bill->gas_bill = $request->gas_bill;
        $bill->others_bill = $request->others_bill;

        $flat->save();
        $flat->bills()->save($bill);

        $request->session()->flash('success', 'New Flat: '.$flat->name.' successfully added !');
        return redirect()->route('flats.index');
        

        // Redirecting to target location
        // if ($flat->save() && $bill->save()) {
        //     return redirect()->route('flats.show',$flat->id);
        // } else {
        //     return redirect()->route('flats.create');
        // }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flat = Flat::findOrFail($id);
        
        return view("flats.show",[
            'page_title' => 'Flat: '.$flat->name,
            'active' => 'flats',
            'heading' => 'Flat: '.$flat->name,
            'flat' => $flat,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flat = Flat::findOrFail($id);
        // dd($flat->bill);
        return view("flats.edit",[
            'page_title' => 'Edit Flat: '.$flat->name,
            'active' => 'flats',
            'heading' => 'Edit Flat: '.$flat->name,
            'flat' => $flat,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $flat = Flat::findOrFail($id);
        $flat->name = $request->flat_name;
        $flat->size = $request->flat_size;
        $flat->save();

        $bill = $flat->bill;

        $new_bill = new Bill();
        $new_bill->rent = $request->flat_rent;
        $new_bill->unit_bill = $request->unit_price;
        $new_bill->gas_bill = $request->gas_bill;
        $new_bill->others_bill = $request->others_bill;

        $request->session()->flash('info','Flat: '.$flat->name.' successfully updated !');


        if($bill->isEqual($new_bill)){
            return redirect()->route('flats.index');
        } else {
            $flat->bills()->save($new_bill);
            return redirect()->route('flats.index');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Show details of the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $flat = Flat::findOrFail($id);
        $flat->load(['tenant','tenant.period','bill','electricity' => function($query){
            $query->where('date',date_create('first day of last month midnight'));
        }]);
        // dd($flat);

        return view("flats.details",[
            'page_title' => 'Details: Flat '.$flat->name,
            'active' => 'flats',
            'heading' => 'Details: Flat '.$flat->name,
            'flat' => $flat,
        ]);
    }

    public function book(Request $request){
        $flat = Flat::findOrFail(base64_decode($request->id));
        
        return view("flats.book",[
            'page_title' => 'Book: Flat '.$flat->name,
            'active' => 'flats',
            'heading' => 'Book: Flat '.$flat->name,
            'flat' => $flat,
        ]);
    }

    public function tenant_update(Request $request){
        $flat = Flat::findOrFail(base64_decode($request->id));
        // dd($flat);
        $flat->load(
            ['tenant'=>function($query){
                $query->where('status','active');
            }, 
            'next_tenant'=>function($query){
                $query->where('status','next');
            }]
        );
        // dd($flat);
        // $date1 = date_create('2009-10-13');
        // $date2 = date_create('2009-10-11');

        // dd(date_create('first day of last month midnight'));
        // dd(new DateTime("2018-11-01 00:00:00") > new DateTime("2018-12-31 23:59:59"));
        // dd(date_create(date('Y-m-d H:i:s',strtotime('first day of this month midnight')-1)));
        if ($flat->tenant) {
            $flat->tenant->status = Tenant::PREV;
            $flat->tenant->save();
            if (!$flat->next_tenant) {
                $flat->status = Flat::EMPTY;
            }
            $flat->save();
        }

        if (isset($flat->next_tenant)  && date_create($flat->next_tenant->period->date_from) < date_create('now')){
            $flat->next_tenant->status = Tenant::ACTIVE;
            $flat->next_tenant->save();
            $flat->status = Flat::BOOKED;
            $flat->save();
        }

        return redirect()->route('flats.index');
    }

}
