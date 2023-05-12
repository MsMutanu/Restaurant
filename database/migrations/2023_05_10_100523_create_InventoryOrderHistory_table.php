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
        Schema::create('InventoryOrderHistory', function (Blueprint $table) {
            $table->string('invorder_id')->primary();
            $table->string('product_id', 50)->index('product_id');
            $table->timestamp('datetime_ordered')->useCurrentOnUpdate()->useCurrent();
            $table->integer('amount');

            $table->index(['invorder_id'], 'Invorder_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('InventoryOrderHistory');
    }
};
