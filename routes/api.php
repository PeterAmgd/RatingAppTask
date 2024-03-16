<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientToUserRatingController;
use App\Http\Controllers\UserToClientRatingController;

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

Route::middleware('auth:api')->group(function () {
    // return $request->user();
    Route::get('rate-clients-Api', [UserToClientRatingController::class, 'indexApi'])->name('rate-clients-Api');
    Route::post('rate-clients-Api', [UserToClientRatingController::class, 'UserRateClientApi'])->name('rate-clients-Api');
});

Route::get('rate-users-Api', [ClientToUserRatingController::class, 'indexApi'])->name('rate-users-Api');
Route::post('rate-users-Api', [ClientToUserRatingController::class, 'ClientRateUserApi'])->name('rate-users-Api');
