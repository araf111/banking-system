<?php

// database/seeders/UsersTableSeeder.php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'account_type' => 'Individual',
                'balance' => 1000.00,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'account_type' => 'Business',
                'balance' => 5000.00,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more users as needed
        ]);
    }
}

