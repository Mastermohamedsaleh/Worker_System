<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminAuthController , WorkerAuthController , ClientAuthController , PostController };
use App\Http\Controller\AdminDashboard\AdminNotificationController;

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


Route::controller(PostController::class)->prefix('worker/post')->group(function (){
  
    Route::post('/add' , 'store')->middleware('auth:worker');
     
});

Route::controller(AdminNotificationController::class)->prefix('admin/notifications')->group(function (){
  
    Route::get('/all' , 'index')->middleware('auth:admin');
    Route::get('/unread' , 'unread')->middleware('auth:admin');
    Route::get('/markread' , 'markread')->middleware('auth:admin');
     
});