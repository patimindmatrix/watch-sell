<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "district";

    public function province(){
        return $this->belongsTo("App\Province", "_province_id");
    }

    public function wards(){
        return $this->hasMany("App\Ward", "_district_id");
    }
}
