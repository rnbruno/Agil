<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banks')->insert([
            ['name' => 'Wallet D', 'email' => 'wallet_@example.com', 'phone' => '54-5412-00', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rececionista', 'email' => 'o_patusco_rececionista@example.com', 'phone' => '54-5412-02', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'User Basic', 'email' => '', 'phone' => '', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Admin', 'email' => 'o_patusco_admin@example.com', 'phone' => '54-5412-77', 'created_at' => now(), 'updated_at' => now()],
            ]);
    }
}
