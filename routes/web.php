<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LecturerHomeController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::prefix('users')->group(function () {
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'store']);
    Route::get('home', [UserController::class, 'home'])->name('home');
});

Route::prefix('lecturers')->group(function () {
    Route::get('home', [LecturerHomeController::class, 'home'])->name('home-lecturer');
    Route::get('timetable', [LecturerHomeController::class, 'timeTable'])->name('timetable-lecturer');
});

Route::group(['middleware' => 'localization'], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/forgot', [LoginController::class, 'forgot'])->name('forgot');
    Route::get('/reset', [LoginController::class, 'resetpass'])->name('reset');
    Route::get('change-language/{language}', [Localization::class, 'changeLanguage'])->name('change-language');
});
