<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public $timestamps = false;

    public function tenant(){
        return $this->belongsTo('App\Tenant');
    }
}
