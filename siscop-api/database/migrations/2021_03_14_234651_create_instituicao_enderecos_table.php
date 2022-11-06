<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituicaoEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicao_enderecos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instituicao_id');
            $table->string('cep');
            $table->string('uf');
            $table->string('cidade');
            $table->string('bairro');
            $table->string('rua');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('instituicao_id')->references('id')->on('instituicoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituicao_enderecos');
    }
}
