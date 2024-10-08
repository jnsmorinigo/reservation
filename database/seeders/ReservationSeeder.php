<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\EmployeeTimeBlock;
use App\Models\EmployeeWorkingHour;
use App\Models\Reservation;
use App\Models\WorkingHour;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->startOfMonth()->addDays(7);

        foreach ($customers as $customer) {

            $availableBlocks = EmployeeTimeBlock::whereBetween('work_date', [$startDate, $endDate])
                ->where('is_reserved', false)
                ->inRandomOrder()
                ->limit(8)
                ->get();

            foreach ($availableBlocks as $block) {
                Reservation::create([
                    'customer_id' => $customer->id,
                    'employee_time_block_id' => $block->id,
                ]);


                $block->update(['is_reserved' => true]);
            }
        }
    }
}
