<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\{AdminAuthController , WorkerAuthController , ClientAuthController };


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::controller(AdminAuthController::class)->prefix('auth/admin')->group(function(){
    Route::post('/login',  'login');
    Route::post('/register',  'register');
    Route::post('/logout',  'logout');
    Route::post('/refresh', 'refresh');
    Route::get('/user-profile', 'userProfile');    
});

Route::controller(WorkerAuthController::class)->prefix('auth/worker')->group(function(){
    Route::post('/login',  'login');
    Route::post('/register',  'register');
    Route::post('/logout',  'logout');
    Route::post('/refresh',  'refresh');
    Route::get('/user-profile',  'userProfile');    
});

Route::controller(ClientAuthController::class)->prefix('auth/client')->group(function(){
    Route::post('/login',  'login');
    Route::post('/register',  'register');
    Route::post('/logout', 'logout');
    Route::post('/refresh',  'refresh');
    Route::get('/user-profile',  'userProfile');    
});