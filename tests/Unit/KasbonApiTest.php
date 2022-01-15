<?php

namespace Tests\Unit;


use Carbon\Carbon;
use Illuminate\Http\Response;
use Tests\TestCase;

class KasbonApiTest extends TestCase
{
    public function test_kasbon_get()
    {
        $request = [
            'bulan' => Carbon::parse('2021-11')->format('Y-m'),
            'belum_disetujui' =>  1,
            'page' => 1,
        ];
        $this->json('get', 'api/kasbon', $request)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    '*' => [
                        'tanggal_diajukan',
                        'tanggal_disetujui',
                        'pegawai' => [
                            'id',
                            'nama',
                            'tanggal_masuk',
                            'total_gaji',
                            'created_at',
                            'updated_at',
                        ],
                        'total_kasbon'
                    ]
                ]
            );
    }

    public function test_kasbon_post()
    {
        $kasbon = [
            'pegawai_id' => $this->faker->numberBetween(1, 50),
            'total_kasbon' => $this->faker->numberBetween(100000, 1000000),
        ];
        $this->json('post', 'api/kasbon', $kasbon)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'tanggal_diajukan',
                    'tanggal_disetujui',
                    'pegawai' => [
                        'id',
                        'nama',
                        'tanggal_masuk',
                        'total_gaji',
                        'created_at',
                        'updated_at',
                    ],
                    'total_kasbon'
                ]
            );
        $this->assertDatabaseHas('kasbons', $kasbon);
    }

    public function test_kasbon_setujui()
    {
        $request = [
            'id' => $this->faker->numberBetween(1, 100),
        ];
        $this->json('patch', 'api/kasbon/setujui', $request)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'tanggal_diajukan',
                    'tanggal_disetujui',
                    'pegawai' => [
                        'id',
                        'nama',
                        'tanggal_masuk',
                        'total_gaji',
                        'created_at',
                        'updated_at',
                    ],
                    'total_kasbon'
                ]
            );
    }

    public function test_kasbon_masal()
    {
        $array_id = array();
        for ($i = 0; $i < 5; $i++) {
            // get a random digit, but always a new one, to avoid duplicates
            $array_id[] = $this->faker->unique()->numberBetween(1, 100);
        }
        $request = [
            'id' => $array_id,
        ];
        $this->json('post', 'api/kasbon/setujui-masal', $request)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    '*' => [
                        'id',
                        'total_kasbon'
                    ]
                ]
            );
    }
}
