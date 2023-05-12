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
        Schema::create('Reservation', function (Blueprint $table) {
            $table->string('reserve_id')->primary();
            $table->string('cust_id', 50)->index('cust_id');
            $table->integer('resttable_no')->index('resttable_no');
            $table->integer('no_of_seats');
            $table->date('date');
            $table->time('time');

            $table->index(['reserve_id'], 'reserve_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Reservation');
    }
};
