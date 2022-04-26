<?php

 namespace App\Actions;

 use App\Http\Requests\RegistrationRequest;
 use App\Models\User;

 class RegisterUsersAction{


     public function handle(RegistrationRequest $request)
     {
         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'phone' => $request->phone,
             'password' => $request->password,

         ]);

         return $user;
     }




 }
