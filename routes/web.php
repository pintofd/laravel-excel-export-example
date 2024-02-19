<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('student', StudentController::class);
Route::get('student_export',[StudentController::class, 'get_student_data'])
    ->name('student.export');
Route::post('/student_import',[StudentController::class,'put_student_data'])
    ->name('student.import');
Route::post('/put_fect_emit',[StudentController::class,'put_fect_emit'])
    ->name('student.put_fect_emit');
Route::post('/put_fect_rec',[StudentController::class,'put_fect_rec'])
    ->name('student.put_fect_rec');