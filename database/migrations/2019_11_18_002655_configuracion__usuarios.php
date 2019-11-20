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
        Schema::create('configuracion_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userId')->unique();
            $table->foreign('userId')->references('id')->on('users');
            $table->string('descuento_almuerzo')->nullable();
            $table->string('descuento_comida')->nullable();
            $table->string('descuento_merienda')->nullable();
            $table->float('precio_hora')->nullable();
            $table->float('precio_hora_estructurada')->nullable();
            $table->float('precio_hora_extra')->nullable();
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
        Schema::dropIfExists('configuracion_usuarios');
    }
}
