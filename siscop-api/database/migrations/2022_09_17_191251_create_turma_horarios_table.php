<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmaHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turma_horarios', function (Blueprint $table) {
            $table->id();
            $table->boolean('ativo');
            $table->integer('dia_semana');
            $table->time('inicio');
            $table->time('termino');
            $table->time('extensao');
            $table->unsignedBigInteger('turma_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('turma_id')->references('id')->on('turmas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turma_horarios');
    }
}
