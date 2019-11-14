<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParteDiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parte_diarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');
            $table->string('dia');
            $table->string('mes');
            $table->string('year');
            $table->string('HoraEntrada',5);
            $table->string('HoraSalida',5);
            $table->string('TotalHoras',5);
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
        Schema::dropIfExists('parte_diarios');
    }
}
