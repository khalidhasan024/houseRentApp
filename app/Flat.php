<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    const BOOKED = "Booked";
    const EMPTY = "Empty";

    public $timestamps = false;

    public function tenants(){
        return $this->hasMany('App\Tenant');
    }
    public function tenant(){
        return $this->hasOne('App\Tenant');
    }
    public function next_tenant(){
        return $this->hasOne('App\Tenant');
    }
    // public function tenant(){
    //     return $this->tenants()->where('status',\App\Tenant::ACTIVE);
    // }
    // public function next_tenant(){
    //     return $this->tenants()->where('status',\App\Tenant::NEXT);
    // }

    public function bill(){
        return $this->hasOne('App\Bill')->latest();
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }

    public function electricity(){
        return $this->hasOne('App\Electricity');
    }
    public function electricities(){
        return $this->hasMany('App\Electricity');
    }
}
