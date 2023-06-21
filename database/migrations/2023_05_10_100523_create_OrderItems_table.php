<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OrderItems', function (Blueprint $table) {
            $table->string('orderitems_id')->primary();
            $table->string('order_id', 50)->index('order_id');
            $table->string('product_id', 50)->index('product_id');

            $table->index(['orderitems_id'], 'orderitems_id');
            
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('OrderItems');
    }
};
