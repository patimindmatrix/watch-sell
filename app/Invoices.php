<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $table = 'invoices';

    public function invoiceDetail(){
        return $this->hasMany("App\InvoicesDetail", "invoices_id");
    }
}
