<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";

    public function categories(){
        return $this -> belongsTo("App\Product_category", "category_id");
    }

    public function tags(){
        return $this -> belongsToMany('App\Product_tags', 'rl_prod_tag', 'prod_id', 'tag_id');
    }

    public function reviews(){
        return $this -> hasMany("App\Review", "product_id");
    }
}
