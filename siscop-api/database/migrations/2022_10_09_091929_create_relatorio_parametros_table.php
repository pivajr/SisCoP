<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatorioParametrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorio_parametros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('relatorio_id');
            $table->string('nome');
            $table->string('coluna');
            $table->string('alias');
            $table->boolean('date')->default(false);
            $table->boolean('required')->default(true);
            $table->timestamps();

            $table->foreign('relatorio_id')->references('id')->on('relatorios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relatorio_parametros');
    }
}
