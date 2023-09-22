<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Department::create([
            'name' => 'ADMINISTRATOR',
            'key' => Str::uuid()->toString(),
        ]);
        Department::create([
            'name' => 'TRAINING',
            'key' => Str::uuid()->toString(),
        ]);
    }
}
