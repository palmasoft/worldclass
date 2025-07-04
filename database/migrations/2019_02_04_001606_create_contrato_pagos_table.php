<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_pagos', function (Blueprint $table) {
            $table->increments('id');

            $table->char('tipo')->default('EFECTIVO');
            $table->char('banco')->nullable();
            $table->char('numero')->nullable();
            $table->char('factura')->nullable();
            $table->char('tarjeta')->nullable();
            $table->char('diferido')->nullable();
            $table->char('autorizacion')->nullable();
            $table->char('lote')->nullable();
            $table->decimal('valor',8,2)->default(0.00);

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
        Schema::dropIfExists('contrato_pagos');
    }
}
