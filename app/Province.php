<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = "province";

    public function districts(){
        return $this->hasMany("App\District", "_province_id");
    }

    public function wards(){
        return $this->hasMany("App\Ward", "_province_id");
    }
}
