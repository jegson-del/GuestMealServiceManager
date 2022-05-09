<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Throwable;

class VerifyController extends Controller
{
    public function verify(Request $request)
    {


        try {
            $OTP = Cache::get('OTP');
            if ($request->OTP === $OTP ){
               auth('sanctum')->user()->isVerified = 1;

            }
            return response()->json(['status' => 201,'message' => 'You are now verified ']);
        }catch (Throwable $e)
        {
            report($e);

            return false;
        }

    }
}
