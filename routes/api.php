<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminAuthController , WorkerAuthController , ClientAuthController , PostController };
use App\Http\Controllers\AdminDashboard\{AdminNotificationController,PostStatusController};

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
    Route::get('/show' , 'index')->middleware('auth:admin');
    Route::get('/approved' , 'approved')->middleware('auth:admin');
     
});

Route::controller(PostStatusController::class)->prefix('admin')->group(function (){
  
    Route::get('/changstatus' , 'changStatusPost')->middleware('auth:admin');
     
});

Route::controller(AdminNotificationController::class)->prefix('admin/notifications')->group(function (){
  
    Route::get('/all' , 'index')->middleware('auth:admin');
    Route::get('/unread' , 'unread')->middleware('auth:admin');
    Route::get('/markread' , 'markread')->middleware('auth:admin');
     
});


// Write a program which will count the "r" characters in the text "w3resource".


Route::get('get' , function(){


//    $word = "w3resource";
//    $r = "r";
//    $count = 0; 

//    for( $i = 0 ; $i < strlen($word) ; $i++ ){
//      if( $word[$i] == $r ) {
//       echo  $n = strlen( $word[$i] ) ;
//      }
//     //  echo $count = $n + 1 ;
//    }


echo '<table align="left" border="1" cellpadding="3" cellspacing="0">';


for($i = 0 ; $i < 6 ; $i++){
    echo "<tr>";
    
    for ($j=1;$j<=5;$j++){

        echo  "<td>".$i * $j = $i*$j ."</td>";

    } //end for one


  echo "</tr>";
}

 
echo '<table>';
 
  




  



});


