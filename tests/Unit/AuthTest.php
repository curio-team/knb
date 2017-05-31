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
        $user = factory(\App\User::class)->make();
        $this->assertEquals(1, count($user));
    }



}
