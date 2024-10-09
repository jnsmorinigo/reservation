<?php

use App\Http\Controllers\Auth\ApiAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


Route::post('/login', [ApiAuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/employees/time-blocks', [EmployeeController::class, 'getEmployeeTimeBlocks']);
});
Route::get('/employees/check-availability', [EmployeeController::class, 'checkEmployeeAvailability'])->name('employees.check-availability-api');
Route::post('/employees/{id}/schedule-email', [EmployeeController::class, 'sendScheduleEmail'])->name('employees.send-schedule-email-api');

