<?php

use Illuminate\Database\Seeder;

class EventGoalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = \App\Event::findOrFail(1);

        \App\EventGoal::create([
            'title'             => 'Get 10 points to do X!',
            'points_required'   => 10,
            'event_id'          => $event->id,
            //'house_id'        => Put a house id here to only allow that house to complete this goal
        ]);
    }
}
