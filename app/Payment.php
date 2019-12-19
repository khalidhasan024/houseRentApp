<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function tenant(){
        return $this->belongsTo('App\Tenant');
    }
}
