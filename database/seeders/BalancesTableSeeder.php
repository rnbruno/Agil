<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BalancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('balances')->insert([
            [
                'account_id' => 1, // Supondo que o ID 1 exista na tabela accounts
                'balance_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'amount' => 1000.00,
            ],
            [
                'account_id' => 2, // Supondo que o ID 2 exista na tabela accounts
                'balance_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'amount' => 3000.00,
            ],
            [
                'account_id' => 3, // Supondo que o ID 3 exista na tabela accounts
                'balance_date' => Carbon::now()->format('Y-m-d'),
                'amount' => 500.00,
            ],
            [
                'account_id' => 4, // Supondo que o ID 1 exista na tabela accounts
                'balance_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'amount' => 1000.00,
            ],
            [
                'account_id' => 5, // Supondo que o ID 2 exista na tabela accounts
                'balance_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'amount' => 3000.00,
            ],
            [
                'account_id' => 6, // Supondo que o ID 3 exista na tabela accounts
                'balance_date' => Carbon::now()->format('Y-m-d'),
                'amount' => 500.00,
            ],
            [
                'account_id' => 7, // Supondo que o ID 1 exista na tabela accounts
                'balance_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'amount' => 1000.00,
            ],
            [
                'account_id' => 8, // Supondo que o ID 2 exista na tabela accounts
                'balance_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'amount' => 3000.00,
            ],
            [
                'account_id' => 9, // Supondo que o ID 3 exista na tabela accounts
                'balance_date' => Carbon::now()->format('Y-m-d'),
                'amount' => 500.00,
            ], [
                'account_id' => 10, // Supondo que o ID 2 exista na tabela accounts
                'balance_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'amount' => 3000.00,
            ],
            [
                'account_id' => 11, // Supondo que o ID 3 exista na tabela accounts
                'balance_date' => Carbon::now()->format('Y-m-d'),
                'amount' => 500.00,
            ],
        ]);
    }
}
