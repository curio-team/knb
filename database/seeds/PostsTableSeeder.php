<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Post;

class PostsTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();
        $posts = [];

        foreach(range(1, 25) as $index)
        {
            $posts[] = Post::create([
                'title' => $faker->sentence . $index,
                'content' => $faker->sentence,
                'author_id' => rand(1, 50)
            ]);
        }

        foreach(range(1, 5) as $index)
        {
            foreach($posts as $post){
                Post::create([
                    'title' => $faker->sentence . $index,
                    'content' => $faker->sentence,
                    'post_id' => $post->id,
                    'author_id' => rand(1, 50)
                ]);
            }
        }
    }
}