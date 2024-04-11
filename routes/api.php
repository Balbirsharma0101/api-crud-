<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


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


Route::post('store', [TaskController::class, 'store']);
Route::post('/view', [TaskController::class, 'index']);
Route::post('/update', [TaskController::class, 'update']);
Route::post('/delete', [TaskController::class, 'destroy']);


