<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelaColunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabela_colunas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tabela_id');
            $table->string('nome');
            $table->timestamps();

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
        Schema::dropIfExists('tabela_colunas');
    }
}
