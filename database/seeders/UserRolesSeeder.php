<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = DB::table('roles')->pluck('id', 'slug');
        $users = DB::table('users')->pluck('id', 'email');

        $map = [
            'admin@doccrm.test'      => 'admin',
            'manager@doccrm.test'    => 'manager',
            'verifier@doccrm.test'   => 'govt_verifier',
            'finance@doccrm.test'    => 'finance_officer',
            'dataentry@doccrm.test'  => 'data_entry_operator',
            'artist@doccrm.test'     => 'artist',
        ];

        foreach ($map as $email => $roleSlug) {
            DB::table('user_roles')->insert([
                'user_id' => $users[$email],
                'role_id' => $roles[$roleSlug],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
