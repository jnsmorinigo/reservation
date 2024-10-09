<?php

namespace App\Exports;

use App\Models\Employee;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesStatus implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate
            ? Carbon::createFromFormat('H:i:s Y-m-d', $startDate, config('app.timezone'))->setTimezone('UTC')
            : null;

        // Convertir la fecha de fin a UTC
        $this->endDate = $endDate
            ? Carbon::createFromFormat('H:i:s Y-m-d', $endDate, config('app.timezone'))->setTimezone('UTC')
            : null;
    }

    public function collection()
    {
        $query = Employee::query()
            ->with(['employeeTimeBlocks' => function ($query) {
                if ($this->startDate) {
                    $query->where('work_date', '>=', $this->startDate->toDateString())
                        ->whereTime('start_time', '>=', $this->startDate->toTimeString());
                }
                if ($this->endDate) {
                    $query->where('work_date', '<=', $this->endDate->toDateString())
                        ->whereTime('end_time', '<=', $this->endDate->toTimeString());
                }
            }]);


        $employees = $query->get();

        $data = [];
        foreach ($employees as $employee) {
            $availableHours = $employee->employeeTimeBlocks->where('is_reserved', false);
            $reservedHours = $employee->employeeTimeBlocks->where('is_reserved', true);

            $data[] = [
                'name' => $employee->user->name,
                'lastname' => $employee->lastname,
                'available_hours' => $availableHours->count(),
                'reserved_hours' => $reservedHours->count(),
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Lastname',
            'Available Hours',
            'Reserved Hours',
        ];
    }
}
