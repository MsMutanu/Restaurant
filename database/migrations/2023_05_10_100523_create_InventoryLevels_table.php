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
        Schema::create('InventoryLevels', function (Blueprint $table) {
            $table->string('inventory_id')->primary();
            $table->string('product_id', 50)->index('product_id');
            $table->integer('instock_quantity');

            $table->index(['inventory_id'], 'inventory_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('InventoryLevels');
    }
};
