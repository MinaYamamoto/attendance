<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeRecordController;

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

Route::middleware('auth')->group(function() {
    Route::get('/',[TimeRecordController::class, 'index']);
    Route::post('/workstart', [TimeRecordController::class, 'store']);
    Route::post('/reststart', [TimeRecordController::class, 'store']);
    Route::patch('/workend', [TimeRecordController::class, 'update']);
    Route::patch('/restend', [TimeRecordController::class, 'update']);
});
