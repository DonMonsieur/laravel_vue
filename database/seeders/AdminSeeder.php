<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'username' => 'Admin 1',
                'email' => 'admin1@example.com',
                'password' => Hash::make('password1'),
            ],
            [
                'username' => 'Admin 2',
                'email' => 'admin2@example.com',
                'password' => Hash::make('password2'),
            ],
            [
                'username' => 'Admin 3',
                'email' => 'admin3@example.com',
                'password' => Hash::make('password3'),
            ],
            [
                'username' => 'Admin 4',
                'email' => 'admin4@example.com',
                'password' => Hash::make('password4'),
            ],
            [
                'username' => 'Admin 5',
                'email' => 'admin5@example.com',
                'password' => Hash::make('password5'),
            ],
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }
    }
}
