<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create user Employee
        $userEmployees = User::factory()->count(3)->make()->toArray();

        foreach ($userEmployees as $userEmployee) {
            $userEmployee['password'] = Hash::make(env('DEFAULT_PASS'));

            $newUser = User::create($userEmployee);

            $employee = Employee::factory()->make()->toArray();
            $employee['user_id'] = $newUser->id;

            Employee::create($employee);
        }
    }
}
