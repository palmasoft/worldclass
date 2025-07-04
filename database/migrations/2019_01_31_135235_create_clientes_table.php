<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tipo')->default(1);
            $table->integer('acompanante')->default(0);
            $table->integer('edad')->nullable();
            $table->date('fechaCita')->nullable();
            $table->time('horaCita')->nullable();
            $table->string('estadoCita', 5)->nullable();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('cedula', 100)->nullable();
            $table->string('pasaporte', 100)->nullable();
            $table->string('sede', 10);
            $table->string('celular', 50)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('email2', 50)->nullable();
            $table->string('pais', 50)->nullable();
            $table->string('provincia', 50)->nullable();
            $table->string('ciudad', 50)->nullable();
            $table->string('direccion', 250)->nullable();
            $table->string('estadoCivil', 50)->nullable();
            $table->string('ocupacion', 50)->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->string('confirmacion', 10)->nullable();
            $table->string('rastreo', 10)->nullable();
            $table->string('calificacion', 10)->nullable();
            $table->string('tmk', 10)->nullable();
            $table->integer('user_id')->default(0);
            $table->integer('soporte1')->default(0);
            $table->integer('soporte2')->default(0);
            $table->integer('soporte3')->default(0);

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
        Schema::dropIfExists('clientes');
    }
}
