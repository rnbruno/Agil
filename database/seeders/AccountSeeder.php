<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accounts')->insert([
            [
                'id_int' => 1, // Este deve corresponder a um ID válido na tabela de contas relacionadas
                'bank_id' => 1,
                'account_number' => '1234567890',
                'account_type' => 'corrente',
                'balance' => 1000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_int' => 2, // Este deve corresponder a um ID válido na tabela de contas relacionadas
                'bank_id' => 1,
                'account_number' => '0987654321',
                'account_type' => 'poupanca',
                'balance' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_int' => 3, // Este deve corresponder a um ID válido na tabela de contas relacionadas
                'bank_id' => 1,
                'account_number' => '09875874',
                'account_type' => 'poupanca',
                'balance' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_int' => 4, // Este deve corresponder a um ID válido na tabela de contas relacionadas
                'bank_id' => 1,
                'account_number' => '09873335874',
                'account_type' => 'poupanca',
                'balance' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_int' => 5, // Este deve corresponder a um ID válido na tabela de contas relacionadas
                'bank_id' => 1,
                'account_number' => '09833175874',
                'account_type' => 'poupanca',
                'balance' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_int' => 6, // Este deve corresponder a um ID válido na tabela de contas relacionadas
                'bank_id' => 1,
                'account_number' => '0934875874',
                'account_type' => 'poupanca',
                'balance' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_int' => 7, // Este deve corresponder a um ID válido na tabela de contas relacionadas
                'bank_id' => 1,
                'account_number' => '64509875874',
                'account_type' => 'poupanca',
                'balance' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_int' => 8, // Este deve corresponder a um ID válido na tabela de contas relacionadas
                'bank_id' => 1,
                'account_number' => '44409875874',
                'account_type' => 'poupanca',
                'balance' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_int' => 8, // Este deve corresponder a um ID válido na tabela de contas relacionadas
                'bank_id' => 1,
                'account_number' => '09234875874',
                'account_type' => 'poupanca',
                'balance' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_int' => 9, // Este deve corresponder a um ID válido na tabela de contas relacionadas
                'bank_id' => 1,
                'account_number' => '331109875874',
                'account_type' => 'poupanca',
                'balance' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_int' => 10, // Este deve corresponder a um ID válido na tabela de contas relacionadas
                'bank_id' => 1,
                'account_number' => '01323875874',
                'account_type' => 'poupanca',
                'balance' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Adicione mais dados conforme necessário
        ]);
    }
}
