<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserPasswordController;
use App\Http\Controllers\VolunteerOpportunityController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category.show');

Route::group(['prefix' => 'opportunities'], function () {
    Route::get('/', [VolunteerOpportunityController::class, 'index'])->name('opportunity.index');

    Route::get('/create', [VolunteerOpportunityController::class, 'create'])
        ->middleware('auth', 'verified')
        ->name('opportunity.create');

    Route::post('/', [VolunteerOpportunityController::class, 'store'])
        ->middleware('auth')
        ->name('opportunity.store');

    Route::get('{volunteerOpportunity}', [VolunteerOpportunityController::class, 'show'])->name('opportunity.show');
});

Route::get('/{user}', [UserProfileController::class, 'show'])->name('user.show');
Route::patch('/{user}', [UserProfileController::class, 'update'])->middleware('auth')->name('user.update');
Route::patch('/{user}/password', UserPasswordController::class)->middleware('auth', 'verified')->name('password.update');
