<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create(); // Inisialisasi Faker

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'number' => $i,
                'name' => $faker->name,
                'address' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => '00999',
                'password' => bcrypt('password'), // Password default
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
