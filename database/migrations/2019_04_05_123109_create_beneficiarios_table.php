<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiarios', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre',64)->nullable();
            $table->string('apellido',64)->nullable();
            $table->string('cedula',64)->nullable();
            $table->string('pasaporte',64)->nullable();
            $table->string('celular',64)->nullable();
            $table->string('telefono',64)->nullable();
            $table->string('email',64)->nullable();
            $table->integer('edad')->default(0);

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
        Schema::dropIfExists('beneficiarios');
    }
}
