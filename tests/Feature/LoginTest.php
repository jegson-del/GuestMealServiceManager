<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     *  test .
     *
     *
     */
    public function test_login_existing_user()
    {
        $user = User::create([
            'name'=> 'raf dev',
            'email' => 'rafdev@mail.com',
            'phone' => '+447547728178',
            'password' => bcrypt('password'),
        ]);
            $response = $this->post('api/login', [

                'email' => $user->email,
                'password' => 'password',
                'phone' => '+447547728178',
                'device_name' => 'iphone'
            ]);
                $response->assertSuccessful();
        $this->assertNotEmpty($response->getContent());
        $this->assertDatabaseHas('personal_access_tokens',[
            'name' => 'iphone',
            'tokenAble_type' => User::class,
            'tokenAble_id' => $user->id
        ]);
    }


    public function  test_get_user_by_token()
    {

        Sanctum::actingAs(
            $user = User::create(
                [
                    'name'=> 'raf dev',
                    'email' => 'rafdev@mail.com',
                    'phone' => '+447547728178',
                    'password' => bcrypt('password'),
                ]
            ),

        );

        $token = $user->createToken('iphone')->plainTextToken;

        $response = $this->get('api/user', [

            'Authorization' => 'Bearer'. $token
        ]);

        $response->assertSuccessful();

        $response->assertJson(function ($json){

            $json->where('email', 'rafdev@mail.com')
                ->missing('password')
                ->etc();
        });
    }
}
