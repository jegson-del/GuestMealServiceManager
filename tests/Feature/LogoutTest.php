<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;
    /**
     *  test .
     *
     *
     */
    public function test_logout_existing_user()
    {

        $user = User::create([
            'name'=> 'raf dev',
            'email' => 'rafdev@mail.com',
            'phone' => '+447547728178',
            'device_name' => 'iphone',
            'password' => bcrypt('password'),
        ]);

        $token = $user->createToken('iphone')->PlainTextToken;

        $response = $this->post('api/logout', [
            'Authorization' => 'Bearer' . $token

        ]);

       $response->assertSuccessful();

       $this->assertDatabaseCount('personal_access_tokens', 0);
    }



}
