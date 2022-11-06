<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnsLatLongPresencas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presencas', function (Blueprint $table) {
            $table->double('latitude')->after('id')->nullable();
            $table->double('longitude')->after('latitude')->nullable();
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
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
}
