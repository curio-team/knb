<?php

use Illuminate\Database\Seeder;
use App\House;

class HousesTableSeeder extends Seeder {
    public function run()
    {
        House::create([
            'name' => 'Script Serpents',
            'description' => 'They be snake coders.'
        ]);
        House::create([
            'name' => 'Database Dragons',
            'description' => 'Storing fire in a structured way'
        ]);
        House::create([
            'name' => 'FooBarbarians',
            'description' => 'Placeholder barbarians'
        ]);
        House::create([
            'name' => 'Variable Vikings',
            'description' => 'The type of vikings there are keeps changing'
        ]);
    }
}