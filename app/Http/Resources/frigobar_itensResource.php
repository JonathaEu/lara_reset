<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class frigobar_itensResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'id' => $this->id,
                'frigobar_id' => $this->frigobar_id,
                'iten_id' => $this->ites_id,
                'qtd_item' => $this->qtd_item,

            ];
    }
}
