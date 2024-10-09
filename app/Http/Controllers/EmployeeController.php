<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesStatus;
use App\Exports\ListHoursExport;
use App\Http\Requests\CheckEmployeeAvailabilityRequest;
use App\Http\Requests\DownloadReportEmployeesStatusRequest;
use App\Http\Requests\DownloadReportListHoursRequest;
use App\Http\Requests\GetEmployeeTimeBlocksRequest;
use App\Http\Requests\SendScheduleEmailRequest;
use App\Mail\EmployeeScheduleMail;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        return view('employees.index');
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

    public function downloadReportEmployeesStatus(DownloadReportEmployeesStatusRequest $request)
    {
        $startDate = $request->input('start_date', false);
        $endDate = $request->input('end_date', false);

        return Excel::download(new EmployeesStatus($startDate, $endDate), 'employees_status.xlsx');
    }


    public function DownloadReportListHours(DownloadReportListHoursRequest $request)
    {
        $startDate = $request->input('start_date', false);
        $endDate = $request->input('end_date',false);
        $type = $request->input('type',false);

        return Excel::download(new ListHoursExport($startDate, $endDate, $type), 'employees_list_hours.xlsx');
    }

    public function sendScheduleEmail(SendScheduleEmailRequest $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found.'], 404);
        }

        $date = $request->input('date', now()->toDateString());

        Mail::to($employee->user->email)->send(new EmployeeScheduleMail($employee, $date));

        return response()->json(['message' => 'Schedule email sent successfully'], 200);
    }

}
