<?php

use App\Http\Controllers\alatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganDataController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/alat', AlatController::class);
Route::apiResource('/pelanggan', PelangganController::class);
Route::apiResource('/pelanggandata', PelangganDataController::class);
Route::get('/admin', [AdminController::class, 'dashboard']); 
Route::post('/admin/login', [AdminController::class, 'login']);
Route::put('/admin/update', [AdminController::class, 'update']);
Route::post('/admin/logout', [AdminController::class, 'logout']);
