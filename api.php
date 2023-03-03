<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
/*                                                                                                                   
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::controller(RegisterController::class)->group(function(){
//     Route::post('register', 'register');
//     Route::post('login', 'login');
// })



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
       return $request->user();
});

Route::controller(AuthController::class)->group(function(){
  
Route::post('/register',[RegisterController::class,'register']);
Route::post('/login',[RegisterController::class,'login']);
  
  
    // Route::post('login', 'login');
    // Route::post('register','register');
});


// Route::post('/uploadfile',[FileUploadController::class,'FileUpload']);

 Route::post('/validate',[IndexController::class,'testData']);

// Route::post('/login',[UserController::class,'index']);

