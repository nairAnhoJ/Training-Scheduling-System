<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id_number' => 'HII-admin',
            'first_name' => 'HII',
            'last_name' => 'ADMINISTRATOR',
            'dept_id' => '1',
            'email' => 'admin@email.com',
            'role' => '0',
            'password' => Hash::make('HI!@dmin2023'),
            'first_time_login' => '0',
            'key' => Str::uuid()->toString(),
        ]);
    }
}
