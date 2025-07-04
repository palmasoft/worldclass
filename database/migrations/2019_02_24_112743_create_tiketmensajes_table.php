<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiketmensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiketmensajes', function (Blueprint $table) {
            $table->increments('id');

            $table->text('mensaje')->nullable();
            $table->string('adjunto',512)->nullable();

            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade'); 
            
            $table->integer('tiket_id')->unsigned();
            $table->foreign('tiket_id')->references('id')->on('tikets')->onDelete('cascade'); 

            $table->string('empleado',256)->nullable();
            $table->integer('empleado_id')->default(0);

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
        Schema::dropIfExists('tiketmensajes');
    }
}
