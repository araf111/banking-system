<?php

// database/seeders/TransactionsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = DB::table('users')->pluck('id');

        DB::table('transactions')->insert([
            [
                'user_id' => 1,
                'type' => 'deposit',
                'amount' => 1000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'type' => 'withdrawal',
                'amount' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'type' => 'deposit',
                'amount' => 2000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'type' => 'withdrawal',
                'amount' => 1500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more transactions as needed
        ]);
    }
}

