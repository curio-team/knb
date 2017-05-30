<?php

use Illuminate\Database\Seeder;

class ScoreTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scoreTypes = [
            [
                'name'         => 'Register',
                'points'       => 3,
                'description'  => 'Points awarded for registering.'
            ],
            [
                'name'         => 'Question asked',
                'points'       => 2,
                'description'  => 'Points awarded for asking a question.'
            ],
            [
                'name'          => 'Question answered',
                'points'        => 2,
                'description'   => 'Points awarded for answering a question.'
            ],
            [
                'name'          => 'Answer Accepted',
                'points'        => 3,
                'description'   => 'Points awarded because your answer is marked as accepted.'
            ],
            [
                'name'          => 'Comment posted',
                'points'        => 1,
                'description'   => 'Points awarded for posting a comment.'
            ],
            [
                'name'          => 'Top weekly commenter',
                'points'        => 3,
                'description'   => 'Points awarded for being the weekly top commenter.'
            ],
            [
                'name'          => 'Top weekly most voted for',
                'points'        => 5,
                'description'   => 'Points awarded for having the weekly most votes'
            ],
            [
                'name'         => 'Top weekly answers',
                'points'        => 4,
                'description'   => 'Points awarded for having the weekly most answers'
            ]
        ];

        foreach($scoreTypes as $type)
        {
            \App\ScoreType::create($type);
        }
    }
}
