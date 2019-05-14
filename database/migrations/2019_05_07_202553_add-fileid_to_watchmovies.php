<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileidToWatchmovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('watchmovies', function (Blueprint $table) {
            $table->string('openloadfileid')->nullable();
            $table->string('streamangofileid')->nullable();
            $table->string('vidcloudfileid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('watchmovies', function (Blueprint $table) {
            //
        });
    }
}
