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
use App\Http\Controllers\UserAvatarController;
use App\Http\Controllers\UserResumeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserPasswordController;
use App\Http\Controllers\VolunteerOpportunityController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category.show');

Route::name('opportunity.')->prefix('opportunities')->group(function () {
    Route::get('/', [VolunteerOpportunityController::class, 'index'])->name('index');

    Route::middleware(['auth'])->group(function () {
        Route::get('/create', [VolunteerOpportunityController::class, 'create'])->middleware('verified')->name('create');
        Route::post('/', [VolunteerOpportunityController::class, 'store'])->name('store');
    });

    Route::get('{volunteerOpportunity}', [VolunteerOpportunityController::class, 'show'])->name('show');
});

Route::get('/volunteer/{volunteer}', [UserProfileController::class, 'show'])->name('volunteer.show');
Route::get('/organization/{organization}', [UserProfileController::class, 'show'])->name('organization.show');

Route::group(['prefix' => '/{user}', 'middleware' => 'auth'], function () {
    Route::patch('', [UserProfileController::class, 'update'])->name('user.update');

    Route::patch('/password', UserPasswordController::class)->middleware('verified')->name('password.update');

    Route::post('/avatar', UserAvatarController::class)->name('avatar.store');

    Route::post('/resume', [UserResumeController::class, 'store'])->name('resume.store');

    Route::delete('/resume', [UserResumeController::class, 'destroy'])->name('resume.destroy');
});
