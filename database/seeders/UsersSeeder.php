<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            'admin@doccrm.test'     => 'admin',
            'manager@doccrm.test'   => 'manager',
            'verifier@doccrm.test'  => 'verifier',
            'finance@doccrm.test'   => 'finance',
            'dataentry@doccrm.test' => 'dataentry',
            'artist@doccrm.test'    => 'artist',
        ];

        foreach ($users as $email => $roleSlug) {

            $user = User::create([
                'name'       => ucfirst($roleSlug),
                'email'      => $email,
                'password'   => Hash::make('password'),
                'status'     => 'active',
                'is_active'  => 1,
                'user_type'  => $roleSlug === 'artist' ? 'artist' : 'organization',
            ]);

            $role = Role::where('slug', $roleSlug)->first();

            if ($role) {
                $user->roles()->syncWithoutDetaching([$role->id]);
            }
        }
    }
}
