<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoBonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_bonos', function (Blueprint $table) {
            $table->increments('id');

            $table->char('bono')->nullable();
            $table->integer('cantidad')->default(0);
            $table->integer('dias')->default(0);
            $table->integer('noches')->default(0);
            $table->integer('personas')->default(0);

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
        Schema::dropIfExists('contrato_bonos');
    }
}
