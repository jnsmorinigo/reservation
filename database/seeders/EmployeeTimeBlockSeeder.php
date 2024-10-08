<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeTimeBlock;
use App\Models\EmployeeWorkingHour;
use App\Models\WorkingHour;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeTimeBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->addMonths(2)->endOfMonth();

        foreach ($employees as $employee) {
            for ($date = $startDate->copy(); $date->lessThanOrEqualTo($endDate); $date->addDay()) {
                $workingHour = WorkingHour::where('day_of_week', strtolower($date->englishDayOfWeek))->first();
                if ($workingHour) {
                    $workStartTime = Carbon::parse($workingHour->start_time);
                    $workEndTime = Carbon::parse($workingHour->end_time);
                    $blockDuration = $employee->block_duration;
                    $lunchStart = Carbon::parse($employee->lunch_break_start);
                    $lunchEnd = Carbon::parse($employee->lunch_break_end);
                    while ($workStartTime->lessThan($workEndTime)) {
                        if ($workStartTime->between($lunchStart, $lunchEnd)) {
                            $workStartTime->addMinutes($blockDuration);
                            continue;
                        }

                        EmployeeTimeBlock::create([
                            'employee_id' => $employee->id,
                            'work_date' => $date->toDateString(),
                            'start_time' => $workStartTime->toTimeString(),
                            'end_time' => $workStartTime->copy()->addMinutes($blockDuration)->toTimeString(),
                            'is_reserved' => false,
                        ]);

                        $workStartTime->addMinutes($blockDuration);
                    }
                }
            }
        }
    }
}
