<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicesDetail extends Model
{
    protected $table = 'invoices_detail';

    public function invoice(){
        return $this->belongsTo("App\Invoices", "invoices_id");
    }

    public function product() {
        return $this->hasOne(Product::class, "id", "product_id");
    }
}
