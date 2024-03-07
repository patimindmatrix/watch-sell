<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = "ward";

    public function province(){
        return $this->belongsTo("App\Province", "_province_id");
    }

    public function district(){
        return $this->belongsTo("App\District", "_district_id");
    }
}
