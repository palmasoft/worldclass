<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosdosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratosdos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('replica',256)->nullable();
            $table->enum('tipo',['UP','DOWN']);
            $table->double('valorContrato')->default(0);
            $table->double('pagoInicial')->default(0);


            $table->integer('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('cascade');

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
        Schema::dropIfExists('contratosdos');
    }
}
