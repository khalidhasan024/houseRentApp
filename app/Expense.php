<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function adjustments(){
        return $this->hasMany('App\Adjustment');
    }
}
