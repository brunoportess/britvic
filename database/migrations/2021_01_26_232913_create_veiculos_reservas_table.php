<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos_reservas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('veiculo_id')->unsigned();
            $table->bigInteger('usuario_id')->unsigned();
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['veiculo_id', 'usuario_id', 'data_inicio']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculos_reservas');
    }
}
