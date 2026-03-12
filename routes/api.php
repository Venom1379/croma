<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CertificateController;

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
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/profile',[AuthController::class,'profile']);

    Route::get('/companies',[CompanyController::class,'index']);

    Route::post('/certificate/store',[CertificateController::class,'store']);

    Route::get('/certificates',[CertificateController::class,'list']);

    Route::get('/certificate/{id}',[CertificateController::class,'detail']);

});


