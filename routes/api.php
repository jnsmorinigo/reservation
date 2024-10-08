<?php

use App\Http\Controllers\Auth\ApiAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/employees/availability', [EmployeeController::class, 'checkAvailability']);
