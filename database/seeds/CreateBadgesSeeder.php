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
            'img_path'        => 'helloworld.png'
        ]);

        Badge::create([
            'title'           => 'Ask, don\'t tell',
            'description'     => 'Heeft een vraag gesteld op amoHUB',
            'img_path'        => 'askdonttell.png'
        ]);

        Badge::create([
            'title'           => 'Tell, don\'t ask',
            'description'     => 'Heeft een vraag beantwoord op amoHUB',
            'img_path'        => 'telldontask.png'
        ]);

        Badge::create([
            'title'            => 'You got accepted!',
            'description'      => 'Een van jouw antwoorden is geaccepteerd als antwoord!',
            'img_path'         => 'yougotaccepted.png'
        ]);

        Badge::create([
            'title'          => 'amoHUB Rookie',
            'description'    => 'Heeft minimaal 10 vragen gesteld en 10 vragen beantwoord',
            'img_path'       => 'badges/amoHUB_rookie.png'
        ]);

        Badge::create([
            'title'          => 'amoHUB Prospect',
            'description'    => 'Heeft minimaal 25 vragen gesteld en 25 vragen beantwoord',
            'img_path'       => 'badges/amoHUB_prospect.png'
        ]);

        Badge::create([
            'title'          => 'amoHUB Elite',
            'description'    => 'Heeft minimaal 50 vragen gesteld en 50 vragen beantwoord',
            'img_path'       => 'badges/amoHUB_elite.png'
        ]);

        Badge::create([
            'title'         => 'Open Dag Assistant',
            'description'   => 'Is minimaal één keer aanwezig geweest tijdens de opleiding bij een open dag of een andere belangrijke bijdrage geleverd aan de open dag.',
            'img_path'      => 'badges/opendagassistent.png'
        ]);

        Badge::create([
            'title'         => 'Open Source Contributor',
            'description'   => 'Heeft een aanzienlijke bijdrage geleverd aan een van de open source projecten van het Radius College.',
            'img_path'      => 'badges/open_source_contributor.png'
        ]);

        Badge::create([
            'title'          => 'Help a youngling out!',
            'description'    => 'Heeft uitgebreid advies gegeven aan een eerdere jaars met betrekking tot code.',
            'img_path'       => 'badges/help_a_youngling_out.png'
        ]);

        Badge::create([
            'title'          => 'Now you be the teacher!',
            'description'    => 'Heeft tijdens het WEL leren of op een ander moment een les voorbereid en gegeven.',
            'img_path'       => 'badges/you_be_teacher.png'
        ]);

        Badge::create([
            'title'          => 'Can you see me?!?',
            'description'    => 'Heeft een portfoliowebsite gemaakt die online staat waar informatie over hemzelf opstaat inclusief een portfolio gedeelte',
            'img_path'       => 'badges/canyouseeme.png'
        ]);

        Badge::create([
            'title'           => 'Always there!',
            'description'     => 'Heeft in een periode een aanwezigheid behaald van 100%',
            'img_path'        => 'badges/alwaysontime.png'
        ]);

        Badge::create([
            'title'           => 'Fashionably on time!',
            'description'     => 'Heeft in een periode 0 te laat meldingen ontvangen',
            'img_path'        => 'badges/ontime.png'
        ]);

        Badge::create([
            'title'           => 'Have an upvote!',
            'description'     => 'Heeft een post een upvote gegeven.',
            'img_path'        => 'takeupvote.png'
        ]);

        Badge::create([
            'title'           => 'Wow you\'re so positive!',
            'description'     => 'Heeft 50 posts een upvote gegeven.',
            'img_path'        => 'sopositive.png'
        ]);

        Badge::create([
            'title'           => 'You get an upvote! And you get an upvote!',
            'description'     => 'Heeft 100 posts een upvote gegeven',
            'img_path'        => '100upvote.png'
        ]);

        Badge::create([
            'title'           => 'Baby Commentator',
            'description'     => 'Heeft een comment geplaatst op een post',
            'img_path'        => 'minorcommentator.png'
        ]);

        Badge::create([
            'title'           => 'Junior Commentator',
            'description'     => 'Heeft tien comments geplaatst op verschillende posts',
            'img_path'        => 'toddlercommentator.png'
        ]);

        Badge::create([
            'title'           => 'Senior Commentator',
            'description'     => 'Heeft 25 comments geplaatst op verschillende posts',
            'img_path'        => 'juniorcommentator.png'
        ]);

        Badge::create([
            'title'            => 'Senior Commentator',
            'description'      => 'Heeft 50 comments geplaatst op verschillende posts',
            'img_path'         => 'seniorcommentator.png'
        ]);


    }
}
