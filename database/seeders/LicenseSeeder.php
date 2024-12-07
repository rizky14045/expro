<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicenseSeeder extends Seeder
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
            DB::table('licenses')->insert([
                'uuid' => $faker->uuid,
                'key' => $faker->uuid,
                'number_license' => $i,
                'license_name' => $faker->name,
                'user_id' => $i,
                'expired_date' => '2024-12-01'
            ]);
        }
    }
}
