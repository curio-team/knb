<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_goals', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('view_partial')->default('default.partials.goal');
            $table->integer('points_required')->unsigned()->nullable(); // Nullable because maybe later we want to have more complex situations (like badge collecting or more complex point queries)
            $table->integer('event_id')->unsigned();
            $table->integer('house_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_goals', function($table) {
            $table->dropForeign('event_goals_event_id_foreign');
            $table->dropForeign('event_goals_house_id_foreign');
        });

        Schema::dropIfExists('event_goals');
    }
}
