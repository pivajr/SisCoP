<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioEnderecosTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario_enderecos', function (Blueprint $table) {
            $table->engine = 'innoDB';
            $table->id();
            $table->unsignedBigInteger('funcionario_id');
            $table->string('cep');
            $table->string('uf');
            $table->string('cidade');
            $table->string('bairro');
            $table->string('rua');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('funcionario_id')->references('id')->on('funcionarios');
        });

    }//end up()


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionario_enderecos');
    }//end down()


}//end class
