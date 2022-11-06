<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatorioTabelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorio_tabelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('relatorio_id');
            $table->unsignedBigInteger('tabela_id');
            $table->timestamps();

            $table->foreign('relatorio_id')->references('id')->on('relatorios');
            $table->foreign('tabela_id')->references('id')->on('tabelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relatorio_tabelas');
    }
}
