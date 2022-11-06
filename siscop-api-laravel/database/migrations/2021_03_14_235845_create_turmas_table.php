<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instituicao_id');
            $table->unsignedBigInteger('user_id');
            $table->string('codigo_turma');
            $table->string('curso');
            $table->string('semestre');
            $table->string('disciplina');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('instituicao_id')->references('id')->on('instituicoes');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turmas');
    }
}
