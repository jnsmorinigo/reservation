<?php

namespace App\Services;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    public function checkAvailability($startTime, $endTime)
    {
        $startTimeUTC = Carbon::parse($startTime)->setTimezone('UTC');
        $endTimeUTC = Carbon::parse($endTime)->setTimezone('UTC');

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
}
