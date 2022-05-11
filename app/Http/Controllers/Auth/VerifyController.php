<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Throwable;

class VerifyController extends Controller
{
    public function verify(Request $request): bool|\Illuminate\Http\JsonResponse
    {

        try {


            if ($request->OTP == Cache::get('OTP')){
                $user = $request->user();
                $user->update(['isVerified'=> 1]);

            }
            return response()->json([ 'message' => 'You are now verified ']);

        }catch (Throwable $e)
        {
            report($e);

            return response()->json([ 'message' => 'Token expired resend token ']);
        }

    }

}
