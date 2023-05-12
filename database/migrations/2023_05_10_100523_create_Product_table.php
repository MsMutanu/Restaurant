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
        Schema::create('Product', function (Blueprint $table) {
            $table->string('product_id', 50)->primary();
            $table->string('name_id', 50)->index('name_id');
            $table->string('category_id', 50)->index('category_id');
            $table->decimal('product_price', 10);
            $table->string('product_details', 500);

            $table->index(['product_id'], 'product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Product');
    }
};
