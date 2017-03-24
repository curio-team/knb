<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\HouseRole;
use App\User;

class UsersAndHouseRolesTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 50) as $index)
        {
            $houseRole = HouseRole::create([
                'house_id' =>rand(1, 4),
                'role_title' => $faker->title,
                'role_level' => rand(0, 100)
            ]);

            User::create([
                'name' => $faker->firstName . ' (the ' . $index . 'st) ' . $faker->lastName,
                'email' => $faker->email,
                'house_role_id' => $houseRole->id,
                'password' => 'secret'
            ]);
        }
    }
}