<?php

namespace Tests\Feature;


use DebugBar\DebugBar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     *  test .
     *
     *
     */
     public  function  test_user_can_be_registered()
     {
         $response = $this->post('api/registration', [

             'name'=> 'raf dev',
             'email' => 'rafdev@mail.com',
             'phone_number' => '+447547728178',
             'password' => 'password',
             'password_confirmation' => 'password',
             'device_name' => 'iphone',
         ]);

         $response->assertSuccessful();

         $this->assertNotEmpty($response->getContent());

         $this->assertDatabaseHas('users', ['email' => 'rafdev@mail.com']);

         $this->assertDatabaseHas('personal_access_tokens', ['name' => 'iphone']);
     }
}
