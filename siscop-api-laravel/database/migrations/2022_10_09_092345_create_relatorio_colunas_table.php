<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatorioColunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorio_colunas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('relatorio_id');
            $table->unsignedBigInteger('coluna_id');
            $table->string('alias');
            $table->string('label');
            $table->string('format')->nullable();
            $table->string('order_by')->nullable();
            $table->timestamps();

            $table->foreign('relatorio_id')->references('id')->on('relatorios');
            $table->foreign('coluna_id')->references('id')->on('tabela_colunas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relatorio_colunas');
    }
}
