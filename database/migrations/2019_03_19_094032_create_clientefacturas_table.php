<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientefacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientefacturas', function (Blueprint $table) {
            $table->increments('id');
            
            $table->decimal('total',8,2)->default(0.0);
            $table->decimal('descuento',8,2)->default(0.0);
            $table->decimal('iva',8,2)->default(0.0);
            $table->decimal('efectivo',8,2)->default(0.0);
            $table->decimal('deposito',8,2)->default(0.0);
            $table->decimal('transferencia',8,2)->default(0.0);
            $table->decimal('tarjeta',8,2)->default(0.0);
            $table->decimal('cheque',8,2)->default(0.0);
            $table->decimal('canje',8,2)->default(0.0);
            $table->integer('diferido')->default(0);
            $table->integer('cliente_id')->default(0);
            $table->string('numero')->unique();
            $table->integer('estado')->default(0);
            $table->string('nombre',64)->nullable();
            $table->string('apellido',64)->nullable();
            $table->string('cedula',64)->nullable();
            $table->string('email',64)->nullable();
            $table->string('codigo',64)->nullable();

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
        Schema::dropIfExists('clientefacturas');
    }
}
