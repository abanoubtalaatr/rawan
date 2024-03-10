<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'admin'], function(){
   Route::group(['prefix' => 'auth'], function(){
        Route::post('login', [\App\Http\Controllers\Admin\Api\AuthController::class,'login']);
   });

    Route::middleware('auth:sanctum')->group(function () {
        Route::resource('packages', \App\Http\Controllers\Admin\Api\PackageController::class);
        Route::resource('opinions', \App\Http\Controllers\Admin\Api\OpinionController::class);
        Route::resource('consultations', \App\Http\Controllers\Admin\Api\ConsultationController::class);
    });
});

//user
Route::get('packages', [\App\Http\Controllers\Admin\Api\PackageController::class,'index']);
Route::get('opinions', [\App\Http\Controllers\Admin\Api\OpinionController::class, 'index']);

Route::get('consultations',[\App\Http\Controllers\Admin\Api\ConsultationController::class,'index']);
Route::post('bookings-consultation',[\App\Http\Controllers\BookingController::class, 'store']);

Route::get('programs', [\App\Http\Controllers\ProgramController::class, 'index']);
Route::post('bookings-program', [\App\Http\Controllers\ProgramController::class,'store']);

Route::get('faqs', [\App\Http\Controllers\FAQController::class, 'index']);


