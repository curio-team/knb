<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HousesTableSeeder::class);
        $this->call(ScoreTypeSeeder::class);
//        $this->call(UsersAndHouseRolesTableSeeder::class);
//        $this->call(PostsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(CreateBadgesSeeder::class);
    }
}
