<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');
        for ($i = 0; $i < 50; $i++) {
            Pegawai::create([
                'nama' => $faker->firstName(),
                'tanggal_masuk' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 months', $timezone = 'Asia/Makassar'),
                'total_gaji' => 4000000,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
