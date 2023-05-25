<?php

use App\Http\Controllers\Api\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//App\Http\Controllers;
use App\Http\Controllers\Api\ProductController;

/*
|-----  ---------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
route::controller(App\Http\Controllers\Api\RegisterController::class)->group (function(){
    route::post('register','register');
    route::post('login','login');
    Route::middleware('auth:sanctum')->post('logout', 'logout');
    Route::middleware(' auth:sanctum')->post('verification', 'sendVerification');
});


Route::resource('/products',ProductController::class)->middleware('auth:sanctum');
Route::get('/send-email',[EmailController::class,'send'])->middleware('auth:sanctum');
Route::get('/export-excel',[ProductController::class,'export']);
Route::post('/import-excel',[ProductController::class,'import']);

