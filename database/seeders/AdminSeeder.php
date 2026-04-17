<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'role' => Role::SUPER_ADMIN,
                'email' => 'super_admin@goodfood.com',
                'password' => 'super_admin',
            ],
            [
                'role' => Role::ADMIN,
                'email' => 'admin@goodfood.com',
                'password' => 'admin',
            ],
        ];

        foreach ($admins as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['role']->value,
                    'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($data['role']->value) . '&background=random&size=512',
                    'password' => Hash::make($data['password']),
                    'email_verified_at' => now(),
                ]
            );

            $user->assignRole($data['role']->value);
        }
    }
}
