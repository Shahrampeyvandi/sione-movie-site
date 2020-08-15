<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('post_author');
            $table->string('title');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->enum('type',['series','movies']);
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('stars')->nullable();  //save in array
            $table->string('poster')->nullable();
            $table->string('duration')->nullable();
            $table->string('released')->nullable();
            $table->string('imdbID')->nullable();
            $table->string('imdbRating')->nullable();
            $table->string('imdbVotes')->nullable();
            $table->string('age_rate')->nullable();
            $table->string('plot')->nullable();
            $table->text('awards')->nullable();
            $table->string('first_publish_date')->nullable();
            $table->string('last_publish_date')->nullable();
            $table->string('post_status')->nullable();
            $table->string('comment_status')->nullable();
            $table->string('publish_status')->nullable();
             $table->integer('comming_soon')->default(0);
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('year')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
