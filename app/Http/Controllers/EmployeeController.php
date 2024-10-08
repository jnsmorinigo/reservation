<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckEmployeeAvailabilityRequest;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }
    public function checkAvailability(CheckEmployeeAvailabilityRequest $request)
    {
        $employees = $this->employeeService->checkAvailability(
            $request->input('start_time'),
            $request->input('end_time'),
            $request->input('timezone')
        );

        return response()->json($employees);
    }

}
