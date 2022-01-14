<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PegawaiResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'nama' => Str::upper(Str::words($this->nama, 1, '')),
            'tanggal_masuk' => Carbon::parse($this->tanggal_masuk)->format('d/m/Y'),
            'total_gaji' => number_format($this->total_gaji, 0, ',', '.'),

        ];
    }
}
