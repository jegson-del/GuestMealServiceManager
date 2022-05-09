<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
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

        Sanctum::actingAs(
            $user = User::create(
                [
                    'name'=> 'raf dev',
                    'email' => 'rafdev@mail.com',
                    'phone_number' => '+447547728178',
                    'isVerified' => 1,
                    'password' => bcrypt('password'),
                ]
            ),

        );

        $token = $user->createToken('iphone')->plainTextToken;

        $response = $this->post('api/logout',[], [
            'Authorization' => 'Bearer' . $token

        ]);

       $response->assertSuccessful();

       $this->assertDatabaseCount('personal_access_tokens', 0);
    }



}
