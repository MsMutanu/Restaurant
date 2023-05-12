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
        Schema::create('RestaurantTable', function (Blueprint $table) {
            $table->string('resttable_id')->index('resttable_id');
            $table->integer('resttable_no')->index('resttable_no');
            $table->string('availability');
            $table->integer('capacity');

            $table->primary(['resttable_id', 'resttable_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RestaurantTable');
    }
};
