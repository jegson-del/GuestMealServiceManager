<?php

 namespace App\Actions;

 use App\Http\Requests\RegistrationRequest;
 use App\Models\User;
 use Illuminate\Support\Facades\Cache;
 use Illuminate\Support\Facades\Hash;



 class RegisterUsersAction{


     public function handle(RegistrationRequest $request)
     {

         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
             'phone_number' => $request->phone_number,
         ]);

             if ($user)
             {
                 $OTP = rand(100000, 999999);
                 Cache::put(['OTP' => $OTP], now()->addMinutes(60));
             }

             return $user;
     }




 }
