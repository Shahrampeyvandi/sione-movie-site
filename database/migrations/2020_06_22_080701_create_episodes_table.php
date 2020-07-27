<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('duration')->nullable();
            $table->string('publish_date')->nullable();
            $table->text('description');
            $table->string('poster');
            $table->integer('season');
            $table->integer('section');
            $table->string('imdbID')->nullable();
            $table->string('imdbRating')->nullable();
             $table->integer('post_id');
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
        Schema::dropIfExists('episodes');
    }
}
