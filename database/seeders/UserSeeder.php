<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => env('DEFAULT_USER'),
            'email' =>env('DEFAULT_EMAIL'),
            'password' => Hash::make(env('DEFAULT_PASS')),

        ]);
    }
}
