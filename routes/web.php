<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientToUserRatingController;
use App\Http\Controllers\UserToClientRatingController;


Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('rate-clients', [UserToClientRatingController::class, 'index'])->name('rate-clients');
    Route::post('rate-clients', [UserToClientRatingController::class, 'UserRateClient'])->name('rate-clients');



    // Transaltions route for React component
    Route::get('/locale/{type}', function ($type) {
        $translations = trans($type);
        return response()->json($translations);
    });
});

Route::get('rate-users', [ClientToUserRatingController::class, 'index'])->name('rate-users');
Route::post('rate-users', [ClientToUserRatingController::class, 'ClientRateUser'])->name('rate-users');
