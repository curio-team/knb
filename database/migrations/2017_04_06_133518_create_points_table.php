<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create a role pivot table for a user with a house
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('points')->nullable();
            $table->string('description')->nullable();
            $table->integer('receiver_id')->unsigned();
            $table->integer('score_type_id')->unsigned();
            $table->integer('benefactor_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('score_type_id')->references('id')->on('score_types');
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->foreign('benefactor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('points', function($table){
            $table->dropForeign('points_receiver_id_foreign');
            $table->dropForeign('points_benefactor_id_foreign');
        });

        Schema::dropIfExists('points');
    }
}
