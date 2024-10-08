<?php

namespace Database\Factories;

use App\Models\EmployeeWorkingHour;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employeeWorkingHour = EmployeeWorkingHour::inRandomOrder()->first();

        $customer = User::inRandomOrder()->first();

        $appointmentDate = Carbon::now()->addDays(rand(1, 30))
            ->setTimeFromTimeString($employeeWorkingHour->workingHour->start_time);

        return [
            'employee_id' => $employeeWorkingHour->employee_id,
            'working_hour_id' => $employeeWorkingHour->working_hour_id,
            'customer_id' => $customer->id,
            'appointment_date' => $appointmentDate,
        ];
    }
}
