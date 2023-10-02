<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class consumoResource extends JsonResource
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
                'id_consumo' => $this->id_consumo,
                'iten_id' => $this->iten_id,
                'frigobar_id' => $this->frigobar_id,
                'reservas_id' => $this->reservas_id,
                'quantidade' => $this->quantidade,
                'valor_total' => $this->valor_total,
            ];
    }
}