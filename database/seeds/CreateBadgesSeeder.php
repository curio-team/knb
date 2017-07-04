<?php

use Illuminate\Database\Seeder;
use \App\Badge;

class CreateBadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Badge::create([
            'title'           => 'Hello World!',
            'description'     => 'Heeft zich geregistreerd op de amoHUB',
            'img_path'        => 'helloworld.png',
            'priority'        => 1
        ]);

        Badge::create([
            'title'           => 'Ask, don\'t tell',
            'description'     => 'Heeft een vraag gesteld op amoHUB',
            'img_path'        => 'Askdonttell.png',
            'priority'        => 2
        ]);

        Badge::create([
            'title'          => 'amoHUB Question Rookie',
            'description'    => 'Heeft 10 vragen gesteld',
            'img_path'       => 'questionrookie.png',
            'priority'        => 3
        ]);

        Badge::create([
            'title'          => 'amoHUB Question Prospect',
            'description'    => 'Heeft minimaal 25 vragen gesteld en 25 vragen beantwoord',
            'img_path'       => 'questionprospect.png',
            'priority'        => 4
        ]);


        Badge::create([
            'title'          => 'amoHUB Question Elite',
            'description'    => 'Heeft minimaal 50 vragen gesteld en 50 vragen beantwoord',
            'img_path'       => 'questionelite.png',
            'priority'        => 5
        ]);

        Badge::create([
            'title'           => 'Tell, don\'t ask',
            'description'     => 'Heeft een vraag beantwoord op amoHUB',
            'img_path'        => 'telldontask.png',
            'priority'        => 6
        ]);

        Badge::create([
            'title'          => 'amoHUB Answer Rookie',
            'description'    => 'Heeft 10 vragen beantwoord',
            'img_path'       => 'answerrookie.png',
            'priority'        => 7
        ]);

        Badge::create([
            'title'          => 'amoHUB Answer Prospect',
            'description'    => 'Heeft 25 vragen beantwoord',
            'img_path'       => 'answerprospect.png',
            'priority'        => 8
        ]);


        Badge::create([
            'title'          => 'amoHUB Answer Elite',
            'description'    => 'Heeft 50 vragen beantwoord',
            'img_path'       => 'answerelite.png',
            'priority'        => 9
        ]);

        Badge::create([
            'title'            => 'You got accepted!',
            'description'      => 'Een van jouw antwoorden is geaccepteerd als oplossing!',
            'img_path'         => '',
            'priority'        => 10
        ]);



        Badge::create([
            'title'           => 'Have an upvote!',
            'description'     => 'Heeft een post een upvote gegeven.',
            'img_path'        => '',
            'priority'        => 11
        ]);

        Badge::create([
            'title'           => 'Wow you\'re so positive!',
            'description'     => 'Heeft 50 posts een upvote gegeven.',
            'img_path'        => '',
            'priority'        => 12
        ]);

        Badge::create([
            'title'           => 'You get an upvote! And you get an upvote!',
            'description'     => 'Heeft 100 posts een upvote gegeven',
            'img_path'        => '',
            'priority'        => 13
        ]);

        Badge::create([
            'title'           => 'Noob Commentator',
            'description'     => 'Heeft een comment geplaatst op een post',
            'img_path'        => '',
            'priority'        => 14
        ]);

        Badge::create([
            'title'           => 'Skilled Commentator',
            'description'     => 'Heeft tien comments geplaatst op verschillende posts',
            'img_path'        => '',
            'priority'        => 15
        ]);

        Badge::create([
            'title'           => 'Veteran Commentator',
            'description'     => 'Heeft 25 comments geplaatst op verschillende posts',
            'img_path'        => '',
            'priority'        => 16
        ]);

        Badge::create([
            'title'            => 'Elite Commentator',
            'description'      => 'Heeft 50 comments geplaatst op verschillende posts',
            'img_path'         => '',
            'priority'        => 17
        ]);
        Badge::create([
            'title'         => 'Open Dag Assistant',
            'description'   => 'Is minimaal één keer aanwezig geweest tijdens de opleiding bij een open dag of een andere belangrijke bijdrage geleverd aan de open dag.',
            'img_path'      => '',
            'priority'        => 18
        ]);

        Badge::create([
            'title'         => 'Open Source Contributor',
            'description'   => 'Heeft een aanzienlijke bijdrage geleverd aan een van de open source projecten van het Radius College.',
            'img_path'      => '',
            'priority'        => 19
        ]);

        Badge::create([
            'title'          => 'Help a youngling out!',
            'description'    => 'Heeft uitgebreid advies gegeven aan een eerdere jaars met betrekking tot code.',
            'img_path'       => '',
            'priority'        => 20
        ]);

        Badge::create([
            'title'          => 'Now you be the teacher!',
            'description'    => 'Heeft tijdens het WEL leren of op een ander moment een les voorbereid en gegeven.',
            'img_path'       => '',
            'priority'        => 21
        ]);

        Badge::create([
            'title'          => 'Can you see me?!?',
            'description'    => 'Heeft een portfoliowebsite gemaakt die online staat waar informatie over hemzelf opstaat inclusief een portfolio gedeelte',
            'img_path'       => '',
            'priority'        => 22
        ]);

        Badge::create([
           'title'          => 'Overachiever!!',
            'description'   => 'Heeft in de opleiding een 9 of hoger behaald.',
            'img_path'      => '',
            'priority'      => 23
        ]);

        Badge::create([
            'title'           => 'Always there!',
            'description'     => 'Heeft in een periode een aanwezigheid behaald van 100%',
            'img_path'        => '',
            'priority'        => 24
        ]);

        Badge::create([
            'title'           => 'Fashionably on time!',
            'description'     => 'Heeft in een periode 0 te laat meldingen ontvangen',
            'img_path'        => '',
            'priority'        => 25
        ]);


    }
}
