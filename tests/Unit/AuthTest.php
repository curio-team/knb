<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;


    public function testLoginUser()
    {
        $user = factory( \App\User::class )->make();
        $this->visit('/login')
            ->type($user->email, 'email')
            ->type('secret', 'password')
            ->press('Submit')
            ->isAuthenticated();


        echo "\n User login works";
    }



}
