<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Electricity extends Model
{
    public $timestamps = false;

    public function flat(){
        return $this->belongsTo('App\Flat');
    }
}
