<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\HouseRole;
use App\Point;
use App\User;

class UsersAndHouseRolesTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 50) as $index)
        {
            $user = User::create([
                'name' => $faker->firstName . ' (the ' . $index . 'st) ' . $faker->lastName,
                'email' => $faker->email,
                'password' => 'secret'
            ]);

            $houseRole = HouseRole::create([
                'user_id' => $user->id,
                'house_id' => rand(1, 4),
                'role_title' => $faker->title,
                'role_level' => rand(0, 1) * 100
            ]);

            for($i=0; $i < rand(1, 50); $i++){
                // Assign a random amount of points
                $point = Point::create([
                    'points' => rand(-25,25),
                    'receiver_id' => $user->id,
                    'benefactor_type' => Point::BENEFACTOR_TYPE_USER_ASSIGNED,
                    'benefactor_id' => rand(1, $index),
                ]);
            }
        }
    }
}