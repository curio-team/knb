<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Event::create([
            'title'             => 'Hello Event!',
            'start_datetime'    => \Carbon\Carbon::create(2017, 11, 27, 23, 00, 00),
            'end_datetime'      => \Carbon\Carbon::create(2017, 12, 27, 23, 00, 00),
            'headmaster_only'   => true
        ]);
    }
}
