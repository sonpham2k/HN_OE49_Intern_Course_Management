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

Route::group(['middleware' => 'localization'], function () {
    Route::prefix('users')->group(function () {
        Route::get('login', [UserController::class, 'login'])->name('login');
        Route::post('login', [UserController::class, 'store'])->name('store');
        Route::get('home', [UserController::class, 'home'])->name('home');
        Route::get('logout', [UserController::class, 'logout'])->name('logout');
    });

    Route::prefix('lecturer')->group(function () {
        Route::get('home', [LecturerHomeController::class, 'home'])->name('home-lecturer');
        Route::get('timetable', [LecturerHomeController::class, 'getTimeTable'])->name('timetable-lecturer');
        Route::get('liststudent/{course_id}', [LecturerHomeController::class, 'listStudent'])
            ->name('liststudent-lecturer');
        Route::get('edit', [LecturerHomeController::class, 'edit'])->name('lecturer.edit');
        Route::put('update', [LecturerHomeController::class, 'update'])->name('lecturer.update');
    });

    Route::prefix('student')->group(function () {
        Route::get('home', [StudentHomeController::class, 'home'])->name('home-student');
        Route::get('timetable', [StudentHomeController::class, 'getTimeTable'])->name('timetable-student');
        Route::get('edit', [StudentHomeController::class, 'edit'])->name('student.edit');
        Route::put('update', [StudentHomeController::class, 'update'])->name('student.update');
        Route::get('register', [StudentHomeController::class, 'registerCourse'])
                ->name('students.register');
        Route::get('liststudent/{course_id}', [StudentHomeController::class, 'listStudent'])
                ->name('liststudent-student');
        Route::get('delete/{course_id}', [StudentHomeController::class, 'deleteCourse'])
                ->name('students.deleteCourse');
    });

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/forgot', [LoginController::class, 'forgot'])->name('forgot');
    Route::get('/reset', [LoginController::class, 'resetpass'])->name('reset');
    Route::get('change-language/{language}', [Localization::class, 'changeLanguage'])->name('change-language');

    Route::resources([
        'students' => StudentController::class,
        'lecturers' => LecturerController::class,
        'courses' => CourseController::class
    ]);
});
