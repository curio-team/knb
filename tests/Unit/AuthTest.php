<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testRegisterUser()
    {

        $this->visit('/register')
            ->type('Tester', 'name')
            ->type('test@test.nl', 'email')
            ->type(1, 'house')
            ->type(100, 'level')
            ->type('secret', 'password')
            ->type('secret', 'password_confirmation')
            ->type( csrf_token(), '_token')
            ->press('Register')
            ->isAuthenticated();

        echo "\n User registration works";
    }


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
