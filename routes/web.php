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
        Route::get('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/forgot-password', [LoginController::class, 'forgot'])->name('forgot');
        Route::post('/forgot-password', [UserController::class, 'sendEmail'])->name('send.mail');
        Route::get('/reset-forgot-password', [UserController::class, 'viewResetForgotPass'])
            ->name('view.reset.forgot.password');
        Route::post('/reset-forgot-password', [UserController::class, 'resetForgotPass'])
            ->name('reset.forgot.password');
        Route::get('/reset', [UserController::class, 'resetpass'])->name('reset');
        Route::post('/reset', [UserController::class, 'storeResetPass'])->name('storeResetPass');
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
        Route::get('chart', [LecturerHomeController::class, 'viewChart'])->name('lecturers.chart');
    });

    Route::prefix('student')->group(function () {
        Route::get('home', [StudentHomeController::class, 'home'])->name('home-student');
        Route::get('timetable', [StudentHomeController::class, 'getTimeTable'])->name('timetable-student');
        Route::get('edit', [StudentHomeController::class, 'edit'])->name('student.edit');
        Route::put('update', [StudentHomeController::class, 'update'])->name('student.update');
        Route::get('searchCourse', [StudentHomeController::class, 'searchCourse'])
            ->name('students.searchCourse');
        Route::get('liststudent/{course_id}', [StudentHomeController::class, 'listStudent'])
            ->name('liststudent-student');
        Route::delete('delete/{course_id}', [StudentHomeController::class, 'deleteCourse'])
            ->name('students-deleteCourse');
        Route::post('registerCourse/{course_id}', [StudentHomeController::class, 'registerCourse'])
            ->name('students-registCourse');
        Route::get('/notifications', [StudentHomeController::class, 'notifications']);
    });

    Route::get('change-language/{language}', [Localization::class, 'changeLanguage'])->name('change-language');

    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::resources([
            'students' => StudentController::class,
            'lecturers' => LecturerController::class,
            'courses' => CourseController::class,
        ]);
        Route::prefix('timetables')->group(function () {
            Route::get('index/{id}', [TimeTableController::class, 'index'])->name('timetables.index');
            Route::post('store/{id}', [TimeTableController::class, 'store'])->name('timetables.store');
            Route::get('edit/{id}/{timetable_id}', [TimeTableController::class, 'edit'])
                ->name('timetables.edit');
            Route::patch('update/{id}/{timetable_id}', [TimeTableController::class, 'update'])
                ->name('timetables.update');
            Route::delete('destroy/{id}', [TimeTableController::class, 'destroy'])
                ->name('timetables.destroy');
        });
    });
});
