<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('title');
            $table->longText('content');
            $table->integer('views')->unsigned()->default(0);
            $table->integer('votes')->default(0);
            $table->integer('flags')->default(0);
            $table->boolean('locked')->default(0);
            $table->boolean('accepted_answer')->nullable();
            $table->integer('post_id')->unsigned()->nullable();

            $table->string('author_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function($table) {
            $table->dropForeign('posts_post_id_foreign');
            $table->dropForeign('posts_author_id_foreign');
        });

        Schema::dropIfExists('posts');
    }
}
