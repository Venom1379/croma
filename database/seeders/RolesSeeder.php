<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Manager', 'slug' => 'manager'],
            ['name' => 'Govt Verifier', 'slug' => 'govt_verifier'],
            ['name' => 'Finance Officer', 'slug' => 'finance_officer'],
            ['name' => 'Data Entry Operator', 'slug' => 'data_entry_operator'],
            ['name' => 'Artist', 'slug' => 'artist'],
        ];

        DB::table('roles')->insert($roles);
    }
}
