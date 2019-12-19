<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function tenant(){
        return $this->belongsTo('App\Tenant');
    }
}
