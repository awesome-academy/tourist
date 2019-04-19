<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tour_id');
            $table->integer('baby_price');
            $table->integer('child_price');
            $table->integer('adult_price');
            $table->string('tour_code');
            $table->date('departure_day');
            $table->date('end_day');
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
        Schema::dropIfExists('type_tours');
    }
}
