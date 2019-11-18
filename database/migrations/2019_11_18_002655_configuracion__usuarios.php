<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConfiguracionUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion_usuarios', function (Blueprint $table){
           $table->bigIncrements('id');
           $table->unsignedBigInteger('userId');
           $table->foreign('userId')->references('id')->on('users');
           $table->string('descuento_almuerzo');
           $table->string('descuento_comida');
           $table->string('descuento_merienda');
           $table->float('precio_hora');
           $table->float('precio_hora_estructurada');
           $table->float('precio_hora_extra');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracion_usuarios');
    }
}
