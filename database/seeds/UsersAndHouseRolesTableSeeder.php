<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\HouseRole;
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
                'password' => 'secret',
            ]);

            HouseRole::create([
                'user_id' => $user->id,
                'house_id' => rand(1, 4),
                'role_title' => $faker->title,
                'role_level' => rand(0, 1) * 100,
            ]);
        }
    }
}
