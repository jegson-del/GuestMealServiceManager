<?php

namespace App\Http\Controllers\Auth;

use App\Actions\RegisterUsersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use Throwable;

class RegistrationController extends Controller
{
    public function register (RegistrationRequest $request, RegisterUsersAction $action)
    {
        try {

            $user = $action->handle($request);
            $token = $user->createToken(request('device_name'))->plainTextToken;
             return response()->json([
                'access_tokens' => $token,
                'token_type' => 'Bearer',
                 'Message' => 'Registration Successful'

            ]);

        }catch (Throwable $e){

                report($e);

            return false;
        }
    }

}
