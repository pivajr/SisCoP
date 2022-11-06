<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf_cnpj');
            $table->string('atividade')->nullable();
            $table->unsignedBigInteger('responsavel_id');
            $table->unsignedBigInteger('qtd_funcionarios');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('responsavel_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituicoes');
    }
}
