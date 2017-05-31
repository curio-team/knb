<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    public function testRegisterUser()
    {



    }

    public function testLoginUser()
    {
        $user = factory(\App\User::class)->make();
        $login = false;
        if ( \Auth::attempt(['email' => $user->email, 'password' => 'secret']) )
        {
            $login = true;
        }

        $this->assertEquals(true, $login,
            'Failed trying to authenticate user...');

    }



}
