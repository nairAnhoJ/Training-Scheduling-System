<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'password' => '$2y$10$A93SkRc5P3Suqt0l6sX91uh1Z4Ec2sMyDAhuuZeB3irIZPEghqtmG',
            'first_time_login' => '0',
            'key' => Str::uuid()->toString(),
        ]);
    }
}
