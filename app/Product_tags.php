<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_tags extends Model{
    protected $table = "product_tags";

    public function products(){
        return $this->belongsToMany("App\Product", "rl_prod_tag","tag_id","prod_id");
    }
}
