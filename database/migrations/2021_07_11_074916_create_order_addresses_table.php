<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("name",255)->nullable();
            $table->string("phone", 255)->nullable();
            $table->string("email", 255)->nullable();
            $table->string("home_address", 255)->nullable();
            $table->string("province", 255)->nullable();
            $table->string("district", 255)->nullable();
            $table->string("ward", 255)->nullable();
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
        Schema::dropIfExists('order_addresses');
    }
}
