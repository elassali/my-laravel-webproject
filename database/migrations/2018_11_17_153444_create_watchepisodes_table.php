<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchepisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchepisodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serie_id');
            $table->integer('season_id');
            $table->Integer('views')->default(0);
            $table->integer('episode_number');
            $table->string('slug');
            $table->string('server1',2048)->nullable();   
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
        Schema::dropIfExists('watchepisodes');
    }
}
