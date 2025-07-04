<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre',64)->nullable();
            $table->string('correo',64)->nullable();
            $table->string('banco',64)->nullable();
            $table->string('cuenta_numero',64)->nullable();
            $table->enum('cuenta_tipo',['AHORROS','CORRIENTE'])->nullable();
            $table->decimal('porcentaje',8,2)->default(0.00);

            $table->string('banco2',64)->nullable();
            $table->string('cuenta_numero2',64)->nullable();
            $table->enum('cuenta_tipo2',['AHORROS','CORRIENTE'])->nullable();

            $table->string('banco3',64)->nullable();
            $table->string('cuenta_numero3',64)->nullable();
            $table->enum('cuenta_tipo3',['AHORROS','CORRIENTE'])->nullable();

            $table->string('banco4',64)->nullable();
            $table->string('cuenta_numero4',64)->nullable();
            $table->enum('cuenta_tipo4',['AHORROS','CORRIENTE'])->nullable();

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
        Schema::dropIfExists('proveedores');
    }
}
