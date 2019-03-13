<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $data = [
            'name',
            'phone_no',
            'user_type',
            'account_balance',
            'email',
            'email_verified_at',
            'password'
        ];

        $this->assertTrue(true);
    }
}
