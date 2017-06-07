<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'name'         => 'C#',
                'thumbnail'     => 'csharp.png'
            ],
            [
                'name'         => 'C++',
                'thumbnail'     => 'cpp.png'
            ],
            [
                'name'         => 'HTML',
                'thumbnail'     => 'html5.png'
            ],
            [
                'name'         => 'CSS',
                'thumbnail'     => 'css3.png'
            ],
            [
                'name'         => 'Git',
                'thumbnail'     => 'git.png'
            ],
            [
                'name'         => 'Javascript',
                'thumbnail'     => 'javascript.png'
            ],
            [
                'name'         => 'SQL',
                'thumbnail'     => 'sql.png'
            ],
            [
                'name'         => 'jQuery',
                'thumbnail'     => 'jQuery.png'
            ],
            [
                'name'          => 'PHP',
                'thumbnail'     => 'php.png'
            ]
        ];

        foreach($tags as $tag)
        {
            \App\Tag::create($tag);
        }

    }
}
