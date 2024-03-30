<?php

use App\Http\Controllers\PayPalController;
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
        Route::resource('programs', \App\Http\Controllers\Admin\Api\ProgramController::class);
        Route::get('bookings-on-consultations', [\App\Http\Controllers\BookingController::class,'bookingConsultations']);
        Route::get('bookings-on-packages', [\App\Http\Controllers\BookingController::class,'bookingPackages']);
        Route::get('bookings-on-programs', [\App\Http\Controllers\BookingController::class,'bookingPrograms']);
    });
});

//user
Route::get('packages', [\App\Http\Controllers\Admin\Api\PackageController::class,'index']);
Route::post('booking-package', [\App\Http\Controllers\Admin\Api\PackageController::class,'bookingPackage']);

Route::get('packages/{package}', [\App\Http\Controllers\Admin\Api\PackageController::class,'show']);

Route::get('opinions', [\App\Http\Controllers\Admin\Api\OpinionController::class, 'index']);

Route::get('consultations',[\App\Http\Controllers\Admin\Api\ConsultationController::class,'index']);
Route::post('bookings-consultation',[\App\Http\Controllers\BookingController::class, 'store']);

Route::get('programs', [\App\Http\Controllers\ProgramController::class, 'index']);
Route::get('programs/{program}', [\App\Http\Controllers\ProgramController::class, 'show']);

Route::post('bookings-program', [\App\Http\Controllers\ProgramController::class,'store']);
Route::post('random-program', [\App\Http\Controllers\Admin\Api\ProgramController::class,'randomProgram']);

Route::get('life-styles',[\App\Http\Controllers\LifeStyleController::class, 'index']);
Route::get('levels', [\App\Http\Controllers\LevelController::class, 'index']);

Route::get('payment', function (Request $request){
 $booking = \App\Models\Booking::query()->find($request->input('booking_id'));

 if($booking->program_id) {
     $program = \App\Models\Program::query()->find($booking->program_id);
     $booking->update(['payment_status'  => 'paid']);


     if ($program->number_of_days == 5) {
         // send email for with like
         $instructionsForProgram5Days = env("instructionsForProgram5Days");
         $data['url'] = $instructionsForProgram5Days;
         (new \App\Service\SendGridService())->sendMail('Instructions', $booking->email, $data, 'emails.booking');
     }
     if ($program->number_of_days == 4) {

         // send email for with like
         $instructionsForProgram5Days = env("instructionsForProgram4Days");
         $data = [
             'url' => env("instructionsForProgram4Days"),
         ];

         (new \App\Service\SendGridService())->sendMail('Instructions', $booking->email, $data, 'emails.booking');
     }
     if ($program->number_of_days == 3) {
         // send email for with like
         $instructionsForProgram5Days = env("instructionsForProgram3Days");
         $data['url'] = $instructionsForProgram5Days;
         (new \App\Service\SendGridService())->sendMail('Instructions', $booking->email, $data, 'emails.booking');
     }
 }

    return redirect('https://rawan-sa.vercel.app/');
});

Route::get('faqs', [\App\Http\Controllers\FAQController::class, 'index']);

