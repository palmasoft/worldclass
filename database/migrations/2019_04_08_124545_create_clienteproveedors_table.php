<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteproveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clienteproveedors', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('cantidad')->default(0);
            $table->decimal('valor_cobrado',8,2)->default(0.0);
            $table->decimal('valor_proveedor',8,2)->default(0.0);
            $table->decimal('utilidad',8,2)->default(0.0);
            $table->string('producto',256)->nullable();
            $table->string('proveedor',256)->nullable();
            $table->string('cuenta',256)->nullable();
            $table->string('correo',256)->nullable();
            $table->decimal('transferencia',8,2)->default(0.0);
            $table->decimal('transferencia_directa',8,2)->default(0.0);
            $table->decimal('deposito',8,2)->default(0.0);
            $table->decimal('deposito_directos',8,2)->default(0.0);

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
        Schema::dropIfExists('clienteproveedors');
    }
}
