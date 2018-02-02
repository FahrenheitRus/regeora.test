<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('smena_id')->unsigned();
            $table->integer('ext_id')->unsigned();
            $table->smallInteger('start_minute');
            $table->smallInteger('end_minute');
            $table->string('ext_departure_id');
            $table->string('ext_arrival_id');
            $table->integer('distance');
            $table->smallInteger('duration');
            $table->tinyInteger('is_industrial');

            $table->foreign('smena_id')
                  ->references('id')
                  ->on('smena');

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
        Schema::dropIfExists('events');
    }
}
