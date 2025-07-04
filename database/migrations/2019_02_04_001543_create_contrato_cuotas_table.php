<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_cuotas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tipo')->default(1);
            $table->decimal('valor',8,2)->default(0.00);
            $table->decimal('saldo',8,2)->default(0.00);
            $table->decimal('pagado',8,2)->default(0.00);
            $table->date('fecha');

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
        Schema::dropIfExists('contrato_cuotas');
    }
}
