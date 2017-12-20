<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEditorsStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function($table) {
            $table->string('updater_id', 100)->nullable();
            $table->foreign('updater_id')->references('id')->on('users');
        });

        Schema::table('comments', function ($table) {

            $table->integer('flags')->default(0);

            $table->string('updater_id', 100)->nullable();

            $table->softDeletes();

            $table->foreign('updater_id')->references('id')->on('users');
        });

        Schema::table('flags', function ($table) {

            $table->integer('add_flag_id')->nullable();

            $table->integer('action')->default(1);
            $table->string('reason', 999);

            $table->integer('comment_id')->unsigned();

            $table->foreign('add_flag_id')->references('id')->on('flags');
            $table->foreign('comment_id')->references('id')->on('comments');

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
            $table->dropForeign('posts_updater_id_foreign');
        });

        Schema::table('comments', function($table) {
            $table->dropForeign('posts_updater_id_foreign');
        });

        Shema::table('flags', function() {
            $table->dropForeign('flags_add_flag_id_foreign');
            $table->dropForeign('flags_comment_id_foreign');
        });
    }
}
