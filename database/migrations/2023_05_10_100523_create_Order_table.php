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
        Schema::create('Order', function (Blueprint $table) {
            $table->string('order_id')->primary();
            $table->string('cust_id', 50)->index('cust_id');
            $table->integer('resttable_no')->index('resttable_no');
            $table->integer('waiter_no')->index('waiter_no');
            $table->timestamp('date_time')->nullable()->useCurrent();
            $table->string('status');
            $table->integer('order_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Order');
    }
};
