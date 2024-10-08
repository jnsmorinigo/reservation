<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\WorkingHour;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkingHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workingHours = collect([
            ['day_of_week' => 'Monday', 'start_time' => '09:00', 'end_time' => '17:00'],
            ['day_of_week' => 'Tuesday', 'start_time' => '09:00', 'end_time' => '17:00'],
            ['day_of_week' => 'Wednesday', 'start_time' => '09:00', 'end_time' => '17:00'],
            ['day_of_week' => 'Thursday', 'start_time' => '09:00', 'end_time' => '17:00'],
            ['day_of_week' => 'Friday', 'start_time' => '09:00', 'end_time' => '17:00'],
        ]);

        foreach ($workingHours as $workingHourData) {
            WorkingHour::create($workingHourData);
        }
    }
}
