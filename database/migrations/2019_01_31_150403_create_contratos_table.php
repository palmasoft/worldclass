<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('sede', 10);
            $table->integer('tipo')->default(1);
            $table->integer('consecutivo');
            $table->integer('titular')->default(0);
            $table->integer('cotitular')->default(0);
            $table->string('nombreSede', 200);
            $table->string('ciudadSede', 200)->nullable();
            $table->string('direccionSede', 200)->nullable();
            $table->integer('anosOtorgados')->default(0);
            $table->integer('anosPactados')->default(0);
            $table->double('gastoLegal')->default(0);
            $table->double('xpack')->default(0);
            $table->double('servicioInternacional')->default(0);
            $table->double('boordingCard')->default(0);
            $table->double('valorContrato')->default(0);
            $table->double('cuotaInicial')->default(0);
            $table->double('pagoInicial')->default(0);
            $table->date('fechaPagoInicial')->nullable();
            $table->double('saldoInicial')->default(0);
            $table->integer('numeroCuotasIniciales')->default(0);
            $table->double('saldoFinanciado')->default(0);
            $table->date('fechaPagoFinanciado')->nullable();
            $table->integer('numeroCuotasFinanciado')->default(0);
            $table->integer('beneficiarios')->default(0);
            $table->string('estadoContrato', 200)->nullable();
            $table->string('estadoComicion', 200)->nullable();
            $table->string('creador', 200)->nullable();
            $table->string('creadorCargo', 200)->nullable();
            $table->integer('estadoServicio')->default(0);
            $table->string('titularNombre', 100)->nullable();
            $table->string('cotitularNombre', 100)->nullable();
            $table->string('tmk', 50)->nullable();
            $table->string('verificado', 50)->nullable();
            $table->integer('intentos')->default(0);
            $table->integer('siUso')->default(0);
            $table->integer('siVigencia')->default(0);
            $table->integer('usos')->default(0);
            $table->double('club')->default(0);
            $table->string('estadoUpgrade', 8)->nullable();
            $table->string('factura', 64)->nullable();
            $table->date('fechaEstado')->nullable();
            $table->double('otrosServicios')->default(0);
            $table->string('estadoCobranza', 256)->nullable();
            $table->integer('legal')->default(0);
            $table->double('saldoFavor')->default(0);

            
            $table->string('one_representante', 64)->default("JOSE MANUEL MOLINA SAMPER");
            $table->string('one_representante_nacionalidad', 64)->default("colombiano");
            $table->string('one_representante_ciudad', 64)->default("Guayaquil");
            $table->string('one_representante_cedula', 64)->default("093300193-5");
            $table->string('one_empresa', 64)->default("ONE CLASS TRAVEL");
            $table->string('one_empresa_comercial', 64)->default("NASELLORIL S.A.");
            $table->string('one_empresa_ruc', 64)->default("0992991291001");
            $table->string('one_empresa_direccion',256)->default("Guayaquil. Av. Carlos Julio Arosemena C.C Albán Borja puerta 1 local 75 P2");
            $table->string('one_empresa_legal', 128)->default("Cámara de Comercio de Guayaquil");

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
        Schema::dropIfExists('contratos');
    }
}
