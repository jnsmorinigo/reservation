<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(WorkingHourSeeder::class);
        $this->call(EmployeeWorkingHourSeeder::class);
        $this->call(EmployeeTimeBlockSeeder::class);
        $this->call(ReservationSeeder::class);
    }
}
