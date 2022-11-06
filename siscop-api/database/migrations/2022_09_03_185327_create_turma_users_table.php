<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turma_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('turma_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('instituicao_id');

            $table->foreign('turma_id')->references('id')->on('turmas');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('instituicao_id')->references('id')->on('instituicoes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turma_users');
    }
}
