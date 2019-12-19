<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tenant;

class TenantController extends Controller
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
        // $active_tenants = Tenant::with(['flat'=>function($query){
        //     $query->orderBy('name','asc');
        // }])->where('status',Tenant::ACTIVE)->get();
        // $next_tenants = Tenant::with('flat')->where('status',Tenant::NEXT)->orderBy('flats.name')->get();
        $tenants = Tenant::with(['flat','period'])->where('status',Tenant::ACTIVE)->orderBy('name')->get();
        $next_tenants = Tenant::with(['flat','period'])->where('status',Tenant::NEXT)->orderBy('name')->get();

        // dd($next_tenants);
        return view("tenant.index",[
            'page_title' => 'Current Tenants',
            'active' => 'tenant',
            'heading' => 'Current Tenants',
            'tenants' => $tenants,
        ]);


    }

    public function next()
    {
        $tenants = Tenant::with(['flat','period'])->where('status',Tenant::NEXT)->orderBy('name')->get();
        // dd($next_tenants);
        return view("tenant.next",[
            'page_title' => 'Next Tenants',
            'active' => 'tenant',
            'heading' => 'Next Tenants',
            'tenants' => $tenants,
        ]);
    }

    public function previous(){
        $tenants = Tenant::with(['flat','period'])->where('status',Tenant::PREV)->orderBy('name')->get();

        return view("tenant.previous",[
            'page_title' => 'Next Tenants',
            'active' => 'tenant',
            'heading' => 'Next Tenants',
            'tenants' => $tenants,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flat = \App\Flat::findOrFail(base64_decode($request->id));

        // dd($request);
        $tenant = new \App\Tenant();
        $tenant->name = $request->name;
        $tenant->profession = $request->profession;
        $tenant->status = \App\Tenant::NEXT;
        $tenant->flat()->associate($flat)->save();
        
        $account = new \App\Account();
        $account->security_money = $request->security_money;
        $account->due = 0;
        $account->tenant()->associate($tenant)->save();

        $contact = new \App\Contact();
        $contact->address = $request->address;
        $contact->phone = $request->phone;
        $contact->id_no = $request->id_no;
        $contact->tenant()->associate($tenant)->save();

        $period = new \App\Period();
        $period->date_from = date('Y-m-d',strtotime("first day of ".$request->date_from));
        $period->tenant()->associate($tenant)->save();
        

        foreach ($request->names as $index => $name) {
            $member = new \App\Member();
            $member->name = $name;
            $member->relation = $request->rel[$index];
            $member->tenant()->associate($tenant)->save();
        }

        $flat->status = \App\Flat::BOOKED;
        $flat->save();

        return redirect()->route('flats.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
