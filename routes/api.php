<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AcceptOrCancelDonationController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\DonationController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\VerifyOtpController;
use App\Http\Controllers\API\VerifyPhoneController;
use App\Http\Controllers\API\GetHospitalsController;
use App\Http\Controllers\API\GetBloodBanksController;
use App\Http\Controllers\API\GetDonationsController;
use App\Http\Controllers\API\RequestDonationController;
use App\Http\Controllers\API\GetHospitalAndBloodBankController;
use App\Http\Controllers\API\GetRequestsOfAskingDonationController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ReadNotificationController;

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
Route::get('/login', function () {
})->name('login');
Route::post('register', [RegisterController::class,'index']);
Route::post('verify_phone', [VerifyPhoneController::class, 'index']);
Route::post('verify_otp', [VerifyOtpController::class, 'index']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(["Token"])->group(function () {
        Route::get('logout', [LogoutController::class, 'logout']);
        Route::get('getHospitals', [GetHospitalsController::class, 'index']);
        Route::get('getBloodBanks', [GetBloodBanksController::class, 'index']);
        Route::post('searchBloodBanks', [SearchController::class, 'index']);
        Route::post('searchHospitals', [SearchController::class, 'index']);
        Route::get('getDonations', [GetDonationsController::class, 'index']);
        Route::get('acceptOrCancelDonation', [AcceptOrCancelDonationController::class, 'index']);
        Route::get('notification', [NotificationController::class, 'index']);
        Route::get('read_notification/{id}', [ReadNotificationController::class, 'index']);
        Route::get('getHospital/{id}', [GetHospitalAndBloodBankController::class, 'index']);
        Route::get('getBloodBank/{id}', [GetHospitalAndBloodBankController::class, 'index']);
        Route::post('donate/', [DonationController::class, 'index']);
        Route::post('requestDonation', [RequestDonationController::class, 'index']);
        Route::get('getRequestsOfAskingDonation', [GetRequestsOfAskingDonationController::class, 'index']);
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
