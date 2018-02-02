<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraphsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graphs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('raspvariant_id')->unsigned();

            $table->integer('num');
            $table->integer('nullRun');
            $table->integer('lineRun');
            $table->integer('totalRun');
            $table->smallInteger('nullTime');
            $table->smallInteger('lineTime');
            $table->smallInteger('otsTime');
            $table->smallInteger('totalTime');
            $table->smallInteger('garageOut');
            $table->smallInteger('garageIn');
            $table->smallInteger('lineBegin');
            $table->smallInteger('lineEnd');


            $table->foreign('raspvariant_id')
                  ->references('id')
                  ->on('raspvariants');

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
        Schema::dropIfExists('graphs');
    }
}
