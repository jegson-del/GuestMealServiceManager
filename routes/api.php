<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerifyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
    Protected routes for user Authentication with sanctum
*/

Route::middleware(['auth:sanctum','TwoFA'])->get('/user', [LoginController::class,'user']);
Route::post('/logout',[LogoutController::class,'logout'])->middleware('auth:sanctum');


Route::post('/verification', [VerifyController::class,'verify'])->middleware(['auth:sanctum']);
/*
    UnProtected routes for user Authentication with sanctum
*/
Route::middleware('TwoFA')->post('/login',[LoginController::class,'login']);
Route::post('/registration',[RegistrationController::class,'register']);




