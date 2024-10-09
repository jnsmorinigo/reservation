<?php

namespace App\Exports;

use App\Enums\TypeListHoursEnum;
use App\Models\Employee;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ListHoursExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;
    protected $type;

    public function __construct($startDate = null, $endDate = null, $type = null)
    {
        $this->startDate = $startDate ? Carbon::parse($startDate) : null;
        $this->endDate = $endDate ? Carbon::parse($endDate) : null;
        $this->type = $type;
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
                        ->whereTime('end_time', '<=', $this->endDate->toTimeString()); // Cambiado a 'end_time'
                }

                if ($this->type == TypeListHoursEnum::available->name) {
                    $query->where('is_reserved', false);
                } elseif ($this->type === TypeListHoursEnum::reserved->name) {
                    $query->where('is_reserved', true);
                }
            }]);

        $employees = $query->get();

        $data = [];
        foreach ($employees as $employee) {
            foreach ($employee->employeeTimeBlocks as $block) {
                $data[] = [
                    'name' => $employee->user->name,
                    'lastname' => $employee->lastname,
                    'work_date' => $block->work_date,
                    'start_time' => $block->start_time,
                    'end_time' => $block->end_time,
                    'status' => $block->is_reserved ? 'Reserved' : 'Available',
                ];
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Lastname',
            'Work Date',
            'Start Time',
            'End Time',
            'Status', // Available or Reserved
        ];
    }
}
