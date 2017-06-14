<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\HouseRole;
use App\Point;
use App\User;

class UsersAndHouseRolesTableSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 50) as $index) {
            $user = User::create([
                'name' => $faker->firstName . ' (the ' . $index . 'st) ' . $faker->lastName,
                'email' => $faker->email,
                'studentnr' => $faker->uuid,
                'password' => bcrypt('secret'),
            ]);

            HouseRole::create([
                'user_id' => $user->id,
                'house_id' => rand(1, 4),
                'role_title' => $faker->title,
                'role_level' => rand(0, 1) * 100,
            ]);

            for($i=0; $i < rand(1, 50); $i++){
                // Assign a random amount of points
                Point::create([
                    'receiver_id' => $user->id,
                    'score_type_id' => rand(1, 8),
                    'benefactor_id' => rand(1, $index),
                ]);
            }
        }
    }
}
