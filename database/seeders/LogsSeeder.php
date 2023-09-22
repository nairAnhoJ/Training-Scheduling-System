<?php

namespace Database\Seeders;

use App\Models\Logs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\Request;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LogsSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // $faker = Faker::create();

        // $cus = Customer::pluck('key')->toArray();
        // $req = Request::pluck('key')->toArray();

        // $randomUuids = [];

        // for ($i = 0; $i < 65000; $i++) {
        //     $randomUuids[] = Str::uuid()->toString();
        // }

        // $com = array_merge($cus, $req, $randomUuids);

        // for ($i = 0; $i < 1000000; $i++) {
        //     DB::table('logs')->insert([
        //         'table' => $faker->randomElement(['REQUEST', 'CUSTOMERS']),
        //         'table_key' => $faker->randomElement($com),
        //         'action' => $faker->randomElement(['UPDATE', 'DELETE', 'CANCEL', 'APPROVE']),
        //         'description' => $faker->sentence(3),
        //         'field' => $faker->randomElement(['Contact Person 1 Name', 'Contact Person 2 Name', 'Address', 'Billing Type', 'Number of Attendees', 'Contract_details', 'Knowledge of Participants', 'Trainer', 'Venue', 'Training Date', 'Number of Unit']),
        //         'before' => $faker->sentence(3),
        //         'after' => $faker->sentence(3),
        //         'user_id' => $faker->numberBetween(2, 4),
        //         'created_at' => $faker->dateTimeBetween('now', '+1 year'),
        //         'updated_at' => $faker->dateTimeBetween('now', '+1 year'),
        //     ]);
        // }
    }
}
