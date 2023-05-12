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
        Schema::create('Waiter', function (Blueprint $table) {
            $table->string('wait_id')->index('wait_id');
            $table->string('name');
            $table->integer('contact');
            $table->integer('waiter_no')->index('waiter_no');

            $table->primary(['wait_id', 'waiter_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Waiter');
    }
};
