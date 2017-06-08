<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('message_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('points_id')->unsigned()->nullable();
            $table->integer('badge_id')->unsigned()->nullable();
            $table->integer('file_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreign('points_id')->references('id')->on('points');
            //$table->foreign('badge_id')->references('id')->on('badges');
            //$table->foreign('file_id')->references('id')->on('file_uploads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attachments', function($table) {
            $table->dropForeign('attachments_message_id_foreign');
            $table->dropForeign('attachments_points_id_foreign');
        });

        Schema::dropIfExists('attachments');
    }
}
