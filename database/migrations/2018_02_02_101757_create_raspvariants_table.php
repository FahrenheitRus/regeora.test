<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaspvariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raspvariants', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('snapTime');
            $table->integer('num');
            $table->date('start');
            $table->date('end')->nullable();
            $table->string('dow')->nullable();
            $table->string('mr_id')->nullable();
            $table->string('mr_num')->nullable();
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
        Schema::dropIfExists('raspvariants');
    }
}
