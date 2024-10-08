<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeWorkingHour;
use App\Models\WorkingHour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeWorkingHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workingHours= WorkingHour::all();

        foreach ($workingHours as $workingHourData) {
            $employees = Employee::all();

            foreach ($employees as $employee) {
                EmployeeWorkingHour::create([
                    'employee_id' => $employee->id,
                    'working_hour_id' => $workingHourData->id,
                ]);
            }
        }
    }
}
