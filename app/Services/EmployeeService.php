<?php

namespace App\Services;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    public function getEmployeeTimeBlocks($startTime, $endTime)
    {
        $startTimeFormatted = Carbon::createFromFormat('H:i:s Y-m-d', $startTime)->format('Y-m-d H:i:s');
        $endTimeFormatted = Carbon::createFromFormat('H:i:s Y-m-d', $endTime)->format('Y-m-d H:i:s');

        $startTimeUTC = Carbon::createFromFormat('Y-m-d H:i:s', $startTimeFormatted, config('app.timezone'))->setTimezone('UTC');
        $endTimeUTC = Carbon::createFromFormat('Y-m-d H:i:s', $endTimeFormatted, config('app.timezone'))->setTimezone('UTC');

        $employees = Employee::with(['employeeTimeBlocks' => function ($query) use ($startTimeUTC, $endTimeUTC) {
            $query->whereBetween('start_time', [$startTimeUTC->toTimeString(), $endTimeUTC->toTimeString()]);
        }])->get();

        return $employees->map(function ($employee) use ($startTimeUTC, $endTimeUTC) {
            $timezone = $employee->timezone;

            $availableBlocks = $employee->getAvailableBlocks($startTimeUTC, $endTimeUTC);
            $reservedBlocks = $employee->getReservedBlocks($startTimeUTC, $endTimeUTC);

            $availableBlocksLocal = $availableBlocks->map(function ($block) use ($timezone) {
                $block->start_time = Carbon::parse($block->start_time)->setTimezone($timezone)->toDateTimeString();
                $block->end_time = Carbon::parse($block->end_time)->setTimezone($timezone)->toDateTimeString();
                return $block;
            });

            $reservedBlocksLocal = $reservedBlocks->map(function ($block) use ($timezone) {
                $block->start_time = Carbon::parse($block->start_time)->setTimezone($timezone)->toDateTimeString();
                $block->end_time = Carbon::parse($block->end_time)->setTimezone($timezone)->toDateTimeString();
                return $block;
            });

            return [
                'employee_id' => $employee->id,
                'employee_timezone' => $employee->timezone,
                'name' => $employee->user->name,
                'available_blocks' => $availableBlocksLocal,
                'reserved_blocks' => $reservedBlocksLocal,
            ];
        });
    }

    public function checkAvailability($dateTime)
    {
        $dateUTC = Carbon::createFromFormat('H:i:s Y-m-d', $dateTime, config('app.timezone'))->setTimezone('UTC');

        $employee = new Employee();

        return $employee->scopeAvailableAt($dateUTC);
    }
}
