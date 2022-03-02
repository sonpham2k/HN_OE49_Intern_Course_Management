<?php

use App\Http\Controllers\LecturerHomeController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

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
    Route::get('liststudent/{course_id}', [LecturerHomeController::class, 'listStudent'])->name('liststudent-lecturer');
    Route::get('edit', [LecturerHomeController::class, 'edit'])->name('edit-lecturer');
    Route::put('update', [LecturerHomeController::class, 'update'])->name('update-lecturer');
});
