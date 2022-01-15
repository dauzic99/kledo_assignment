<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Tests\TestCase;

class PegawaiApiTest extends TestCase
{

    public function test_pegawai_get()
    {
        $this->json('get', 'api/pegawai')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    '*' => [
                        'nama',
                        'tanggal_masuk',
                        'total_gaji',
                    ]
                ]
            );
    }

    public function test_pegawai_post()
    {
        $pegawai = [
            'nama' => $this->faker->firstName,
            'tanggal_masuk' =>  Carbon::parse($this->faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 months', $timezone = 'Asia/Makassar'))->format('Y-m-d'),
            'total_gaji' => $this->faker->numberBetween(4000000, 10000000),
        ];
        $this->json('post', 'api/pegawai', $pegawai)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'nama',
                    'tanggal_masuk',
                    'total_gaji',
                ]
            );
        $this->assertDatabaseHas('pegawais', $pegawai);
    }
}
