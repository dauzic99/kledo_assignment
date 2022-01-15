<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KasbonSetujuiMasalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'total_kasbon' => number_format($this->total_kasbon, 0, ',', '.'),
        ];
    }
}
