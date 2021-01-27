<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->char('ano', 4);
            $table->char('placa', 8);
            $table->tinyInteger('ativo')->default(1);
            $table->bigInteger('usuario_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['deleted_at', 'placa'], 'unique_placa');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculos');
    }
}
