<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("order", function (Blueprint $table){
            $table->id();
            $table->integer("user_id");
            $table->integer("address_id");
            $table->integer("coupon_id")->nullable();
            $table->string("pay_method", 255)->nullable();
            $table->string("price_total", 255)->nullable();
            $table->string("status", 255)->default("Đang xử lý");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("order");
    }
}
