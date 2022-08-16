<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::middleware('auth:api')->get('/users', function () {
    return User::all();
});

Route::post('login' ,[AuthenticationController::class , 'login']);
Route::post('register' ,[AuthenticationController::class , 'register']);
Route::middleware('auth:api')->get('logout' ,[AuthenticationController::class , 'logout']);
Route::middleware('auth:api')->post('/rest-password',[AuthenticationController::class , 'resetPassword']);
