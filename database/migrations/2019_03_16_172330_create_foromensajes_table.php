<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForomensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foromensajes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('usuario',64)->nullable();
            $table->integer('tipo')->default(0);
            $table->integer('user_id')->default(0);
            $table->text('mensaje')->nullable();

            $table->integer('foro_id')->unsigned();
            $table->foreign('foro_id')->references('id')->on('foros')->onDelete('cascade');

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
        Schema::dropIfExists('foromensajes');
    }
}
