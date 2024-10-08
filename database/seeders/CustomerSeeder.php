<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create user Customer
        $userCustomers = User::factory()->count(3)->make()->toArray();

        foreach ($userCustomers as $userCustomer) {
            $userCustomer['password'] = Hash::make(env('DEFAULT_PASS'));

            $newUser = User::create($userCustomer);

            $customer = Customer::factory()->make()->toArray();
            $customer['user_id'] = $newUser->id;

            Customer::create($customer);
        }
    }
}
