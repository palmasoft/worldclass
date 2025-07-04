<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->increments('id');

            $table->char('sede')->unique();
            $table->char('nombre')->nullable();
            $table->char('direccion')->nullable();
            $table->char('ciudad')->nullable();
            $table->integer('consecutivo')->default(0);
            $table->integer('metaq1')->default(0);
            $table->integer('metaq2')->default(0);
            $table->integer('metaq3')->default(0);
            
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
        Schema::dropIfExists('sedes');
    }
}
