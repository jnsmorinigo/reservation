<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckEmployeeAvailabilityRequest;
use App\Http\Requests\GetEmployeeTimeBlocksRequest;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }
    public function getEmployeeTimeBlocks(GetEmployeeTimeBlocksRequest $request)
    {
        $employees = $this->employeeService->getEmployeeTimeBlocks(
            $request->input('start_time'),
            $request->input('end_time'),
        );

        return response()->json($employees);
    }

    public function checkEmployeeAvailability(CheckEmployeeAvailabilityRequest $request)
    {
        $employees = $this->employeeService->checkAvailability(
            $request->input('date_time'),
        );

        return response()->json($employees);
    }

}
