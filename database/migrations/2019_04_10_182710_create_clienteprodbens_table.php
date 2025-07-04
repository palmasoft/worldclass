<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteprodbensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clienteprodbens', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre',128)->nullable();
            $table->string('apellido',128)->nullable();
            $table->string('cedula',128)->nullable();
            $table->string('pasaporte',128)->nullable();
            $table->string('fechaNacimiento',128)->nullable();
            $table->string('edad',128)->nullable();
            $table->string('caducidadPasaporte',128)->nullable();

            
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('clienteprods')->onDelete('cascade');

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
        Schema::dropIfExists('clienteprodbens');
    }
}
