<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnImagemIdTablePresencas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presencas', function (Blueprint $table) {
            $table->unsignedBigInteger('imagem_id')->nullable();
            $table->foreign('imagem_id')->references('id')->on('presencas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presencas', function (Blueprint $table) {
            $table->dropForeign(['imagem_id']);
            $table->dropColumn('imagem_id');
        });
    }
}
