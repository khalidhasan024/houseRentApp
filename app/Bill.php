<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function flat(){
        return $this->belongsTo('App\Flat');
    }

    public function isEqual(Bill $bill){
        if ($this->rent != $bill->rent) {
            return false;
        } elseif ($this->unit_bill != $bill->unit_bill) {
            return false;
        } elseif ($this->gas_bill != $bill->gas_bill) {
            return false;
        }elseif ($this->others_bill != $bill->others_bill) {
            return false;
        } else {
            return true;
        }
        
    }
}
