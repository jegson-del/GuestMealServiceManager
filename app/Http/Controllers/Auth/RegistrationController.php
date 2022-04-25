<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class RegistrationController extends Controller
{
    public function register (Request $request): bool
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'phone' => 'required',
                'device_name' => 'required',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,

            ]);

            return $user->createToken(request('device_name'))->plainTextToken;

        }catch (Throwable $e){

                report($e);

            return false;
        }
    }

}
