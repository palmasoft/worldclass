<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->default(0);
            $table->char('tipo')->default('TMK');
            $table->integer('codigo')->default(1000);
            $table->char('nombre');
            $table->char('apellido');
            $table->char('cedula')->nullable();
            $table->char('pasaporte')->nullable();
            
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
        Schema::dropIfExists('tmks');
    }
}
