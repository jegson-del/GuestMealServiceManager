<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\OtpRequest;
use Throwable;

class VerifyController extends Controller
{
    public function verify(OtpRequest $request)
    {


        try {

               $user = $request->user();

            if ($request->OTP == $user->OTP()){

                $user->update(['isVerified'=> 1]);



            }
               return response()->json([ 'message' => 'You are now verified ']);

        }catch (Throwable $e)
        {
            report($e);

            return response()->json([ 'OTP' => $e, 'message' => 'OTP expired resend OTP']);
        }

    }

}
