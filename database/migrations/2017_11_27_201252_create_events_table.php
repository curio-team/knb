<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration for events.
 *  In events users have to complete goals (this is to incite users to gain more points)
 *  Administrators will unlock/configure more events after an event is finished to progress a certain storyline. This is done manually to adjust the event to the real life behaviours of users.
 */
class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('view')->default('default.index');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->boolean('headmaster_only'); // For testing and development of new events
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
        Schema::dropIfExists('events');
    }
}
