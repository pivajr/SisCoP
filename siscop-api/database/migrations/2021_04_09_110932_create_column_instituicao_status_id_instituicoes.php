<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnInstituicaoStatusIdInstituicoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->unsignedBigInteger('instituicao_status_id');
            $table->foreign('instituicao_status_id')->references('id')->on('instituicao_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->dropForeign(['instituicao_status_id']);
            $table->dropColumn('instituicao_status_id');
        });
    }
}
