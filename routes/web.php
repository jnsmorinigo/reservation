<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/time-blocks', [EmployeeController::class, 'getEmployeeTimeBlocks'])->name('employees.time-blocks');
    Route::get('/employees/check-availability', [EmployeeController::class, 'checkEmployeeAvailability'])->name('employees.check-availability');

    Route::get('/employees/report/employees-status', [EmployeeController::class, 'downloadReportEmployeesStatus'])->name('employees.reportEmployeesStatus');
    Route::get('/employees/report/list-hours', [EmployeeController::class, 'DownloadReportListHours'])->name('employees.reportListHours');
});

require __DIR__.'/auth.php';
