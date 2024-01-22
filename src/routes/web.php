<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeRecordController;
use App\Http\Controllers\AttendanceListController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\UserListController;

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
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::middleware('verified')->group(function() {
    Route::get('/',[TimeRecordController::class, 'index']);
    Route::post('/workstart', [TimeRecordController::class, 'store']);
    Route::post('/reststart', [TimeRecordController::class, 'store']);
    Route::patch('/workend', [TimeRecordController::class, 'update']);
    Route::patch('/restend', [TimeRecordController::class, 'update']);
    Route::get('/attendance', [AttendanceListController::class, 'index']);
    Route::get('/attendance/search', [AttendanceListController::class, 'search']);
    Route::get('/userlist', [UserListController::class, 'index']);
    Route::get('/userlist/worksearch', [UserListController::class, 'search'])->name('userwork.search');
});
