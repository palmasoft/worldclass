<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComicionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comicionables', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('comicion',8,2)->default(0.00);
            $table->decimal('pack',8,2)->default(0.00);
            $table->decimal('xpack',8,2)->default(0.00);

            $table->decimal('pagado1',8,2)->default(0.00);
            $table->decimal('pagado2',8,2)->default(0.00);
            $table->decimal('pagado3',8,2)->default(0.00);
            
            $table->integer('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('cascade');

            $table->integer('cargo_id')->unsigned();
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
            
            $table->integer('empleado_id')->unsigned();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');

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
        Schema::dropIfExists('comicionables');
    }
}
