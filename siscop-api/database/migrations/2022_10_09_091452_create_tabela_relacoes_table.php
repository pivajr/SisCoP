<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelaRelacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabela_relacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tabela_pai_id');
            $table->unsignedBigInteger('tabela_rel_id');
            $table->string('tabela_pai_alias');
            $table->string('tabela_rel_alias');
            $table->string('tabela_pai_fk');
            $table->string('tabela_rel_fk');
            $table->timestamps();

            $table->foreign('tabela_pai_id')->references('id')->on('tabelas');
            $table->foreign('tabela_rel_id')->references('id')->on('tabelas');
            $table->unique(['tabela_pai_id', 'tabela_rel_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabela_relacoes');
    }
}
