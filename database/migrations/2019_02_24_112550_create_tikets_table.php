<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('asunto',128)->nullable();
            $table->string('departamento',128)->nullable();
            $table->string('servicio_relacionado',256)->nullable();
            $table->enum('prioridad',['ALTA','MEDIA','BAJA']);
            $table->integer('cliente_id')->default(0);
            $table->integer('estado')->default(0);//0 abierto, 1 respondido, 2 res del cli, 3 cerrado
            $table->enum('estado2',['P','G','S','V','C'])->default('P');

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
        Schema::dropIfExists('tikets');
    }
}
