<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Kasbon;

class KasbonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            Kasbon::create([
                'tanggal_diajukan' => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now', $timezone = 'Asia/Makassar'),
                'pegawai_id' => $faker->numberBetween(1, 50),
                'total_kasbon' => 300000,
            ]);
        }
    }
}
