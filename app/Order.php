<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";

    protected $fillable = ['status', 'updated_at'];

    public function orderDetails(){
        return $this->hasMany("App\OrderDetail", "order_id");
    }

    public function orderAddress(){
        return $this->belongsTo("App\OrderAddress", "address_id");
    }

    public function user(){
        return $this->belongsTo("App\User", "user_id");
    }
}
