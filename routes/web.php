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
use App\Http\Controllers\VolunteerOpportunityController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/opportunities', [VolunteerOpportunityController::class, 'index'])->name('opportunity.index');
Route::get('/{user}/{volunteerOpportunity}', [VolunteerOpportunityController::class, 'show'])->name('opportunity.show');
