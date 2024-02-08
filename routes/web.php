<?php

use App\Http\Controllers\FmcController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\OnlySessionHasMiddleware;
use App\Http\Middleware\OnlySessionMissingMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home_controller
Route::get('/', [HomeController::class, 'index'])->middleware(OnlySessionMissingMiddleware::class);

Route::get('/Home/new-profile', [HomeController::class, 'newProfile'])->middleware(OnlySessionMissingMiddleware::class);

/*  end Home_controller */

/* Profile_controller */
Route::get('/Profile/select-club', [ProfileController::class, 'selectClub'])->middleware(OnlySessionHasMiddleware::class);

Route::get('/Profile/load-profile', [ProfileController::class, 'loadProfile'])->middleware(OnlySessionMissingMiddleware::class);
/* end Profile_controller */

/* FmcController */
Route::get('/FMC', [FmcController::class, 'index'])->middleware(OnlySessionHasMiddleware::class);
/* end FmcController */
