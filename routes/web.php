<?php

use App\Http\Controllers\HomeController;
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
Route::get('/', [HomeController::class, 'index']);

Route::get('/Home/new-profile', [HomeController::class, 'newProfile']);

Route::get('/Home/select-club', [HomeController::class, 'selectClub']);
/*  end Home_controller */
