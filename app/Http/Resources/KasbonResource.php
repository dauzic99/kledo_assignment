<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class KasbonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->tanggal_disetujui != null) {
            $tanggal_disetujui = Carbon::parse($this->tanggal_disetujui)->format('d/m/Y');
        } else {
            $tanggal_disetujui = null;
        }
        return [
            'tanggal_diajukan' => Carbon::parse($this->tanggal_diajukan)->format('d/m/Y'),
            'tanggal_disetujui' => $tanggal_disetujui,
            'pegawai' => $this->pegawai,
            'total_kasbon' => number_format($this->total_kasbon, 0, ',', '.'),
        ];
    }
}
