<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Register student
Route::post('/registerStudent', [StudentAPIController::class, 'registerStudent']);
//Get All Student
Route::get('/getStudents', [StudentAPIController::class, 'getAllStudent']);
//Get Student by ID
Route::get('/getStudent/{id}', [StudentAPIController::class, 'getStudentID']);
//Update Student
Route::put('/updateStudent/{id}', [StudentAPIController::class, 'updateStudent']);
//Delete Student
Route::delete('deleteStudent/{id}', [StudentAPIController::class, 'deleteStudent']);
