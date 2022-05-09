<?php

namespace App\Http\Controllers\Auth;

use App\Actions\RegisterUsersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Notifications\SendSmsToNewUser;

use Illuminate\Support\Facades\Notification;
use Throwable;


class RegistrationController extends Controller
{
    public function register (RegistrationRequest $request, RegisterUsersAction $action)
    {


        try {

            $user = $action->handle($request);

            $token = $user->createToken(request('device_name'))->plainTextToken;

            $OTP = $user->OTP();

            Notification::send($user, New SendSmsToNewUser($user,$OTP));

             return response()->json(['user' => $user,'token' => $token, 'OTP' => $OTP, 'message' => 'Registration successful']);


        }catch (Throwable $e){

                report($e);

            return false;
        }

    }

}
