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

//    public function __construct()
//    {
//        $this->middleware('TwoFA');
//    }

    public function login(LoginRequest $request)
    {


        try {

            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {

                throw  ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],

                ]);

            }

            $token = $user->createToken($request->device_name)->plainTextToken;

            return response()->json([
                'user' => $user->name,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'message' => 'Login Successfully'
            ]);

        }catch (Throwable $e)
        {
            report($e);

            return response()->json($e->getMessage());

        }

    }

    public function user(Request $request)
    {
        return $request->user();
    }
}
