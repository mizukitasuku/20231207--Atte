<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StampController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OtherController;

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

Route::middleware('auth')->group(function () {
Route::get('/', [StampController::class, 'stampView']);
});

Route::get('/login', [LoginController::class, 'loginView'])->name('login');


Route::get('/logout', [LoginController::class, 'logoutView']);


Route::get('/register', [RegisterController::class, 'registerView']);


Route::get('/attendance', [AttendanceController::class, 'dataView'])->name('attendance.index');

Route::get('/user-attendance', [UserController::class, 'userPage'])->name('user-attendance.index');

Route::get('user-details/{id}', [UserController::class, 'showUserDetails']);

Route::get('/other-attendance', [OtherController::class, 'userOther'])->name('other-attendance.index');

// 勤務開始
Route::post('/stamp-start', [StampController::class, 'stampStart'])->name('stamp.start');
Route::get('/stamp-start', [StampController::class, 'stampView']);

// 勤務終了
Route::post('/stamp-end', [StampController::class, 'stampEnd'])->name('stamp.end');
Route::get('/stamp-end', [StampController::class, 'stampView']);

// 休憩開始
Route::post('/break-start', [StampController::class, 'breakStart'])->name('break.start');
Route::get('/break-start', [StampController::class, 'stampView']);

// 休憩終了
Route::post('/break-end', [StampController::class, 'breakEnd'])->name('break.end');
Route::get('/break-end', [StampController::class, 'stampView']);

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
