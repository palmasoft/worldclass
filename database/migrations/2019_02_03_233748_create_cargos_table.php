<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->increments('id');

            $table->char('nombre')->unique();
            $table->decimal('comicion_proce',8,2)->default(0.00);
            $table->decimal('comicion_cash',8,2)->default(0.00);
            $table->decimal('pack',8,2)->default(0.00);
            $table->decimal('xpack',8,2)->default(0.00);

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
        Schema::dropIfExists('cargos');
    }
}
