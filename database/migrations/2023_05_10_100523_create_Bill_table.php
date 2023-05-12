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
        Schema::create('Bill', function (Blueprint $table) {
            $table->string('bill_id', 50)->primary();
            $table->string('cust_id', 50)->index('cust_id');
            $table->string('order_id')->index('order_id');
            $table->integer('resttable_no')->index('resttable_no');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->double('total');
            $table->integer('waiter_no')->index('waiter_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Bill');
    }
};
