<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    const ACTIVE = "active";
    const NEXT = "next";
    const PREV = "previous";


    
    public function flat(){
        return $this->belongsTo('App\Flat');
    }

    public function contact(){
        return $this->hasOne('App\Contact');
    }

    public function members(){
        return $this->hasMany('App\Member');
    }

    public function period(){
        return $this->hasOne('App\Period');
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function account(){
        return $this->hasOne('App\Account');
    }
}
