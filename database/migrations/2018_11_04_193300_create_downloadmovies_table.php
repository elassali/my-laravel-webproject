<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadmoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downloadmovies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movie_id')->unsigned()->index();
            $table->string('server1',2048)->nullable();   
            $table->string('server2',2048)->nullable();   
            $table->string('server3',2048)->nullable();   
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
        Schema::dropIfExists('downloadmovies');
    }
}
