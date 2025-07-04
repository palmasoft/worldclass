<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteprodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clienteprods', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('valor',8,2)->default(0.0);
            $table->integer('cantidad')->default(0);
            $table->decimal('valor_unitario',8,2)->default(0.0);
            $table->string('producto',256)->nullable();
            $table->string('proveedor',256)->nullable();
            
            $table->decimal('valor_proveedor',8,2)->default(0.0);
            $table->decimal('utilidad',8,2)->default(0.0);
            $table->string('cuenta',256)->nullable();
            $table->string('correo',256)->nullable();
            $table->string('transferencia',256)->nullable();
            $table->string('transferencia_directa',256)->nullable();
            $table->string('deposito',256)->nullable();
            $table->string('deposito_directo',256)->nullable();

            $table->integer('factura_id')->unsigned();
            $table->foreign('factura_id')->references('id')->on('clientefacturas')->onDelete('cascade');
            
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
        Schema::dropIfExists('clienteprods');
    }
}
