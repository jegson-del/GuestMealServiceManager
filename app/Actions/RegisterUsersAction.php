<?php

 namespace App\Actions;

 use App\Http\Requests\RegistrationRequest;
 use App\Models\User;
 use Illuminate\Support\Facades\Cache;


 class RegisterUsersAction{


     public function handle(RegistrationRequest $request)
     {
         $user = User::create($request->all());

             if ($user)
             {
                 $OTP = rand(100000, 999999);
                 Cache::put(['OTP' => $OTP], now()->addSecond(900));
             }

             return $user;
     }




 }
