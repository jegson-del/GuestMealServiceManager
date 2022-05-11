<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class LoginController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request){


        try {

            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'error' => ['The provided credentials are incorrect.'],
                ]);
            }


            return  $user->createToken($request->device_name)->plainTextToken;

//            return response()->json([
//                'access_token' => $token,
//                'token_type' => 'Bearer',
//                'message' => 'Login successfully '
//            ]);


        }catch (Throwable $e)
        {
            report($e);

            return false;

        }

    }

    public function user(Request $request)
    {
        return $request->user();
    }
}
