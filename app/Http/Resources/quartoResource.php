<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class quartoResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'numero' => $this->numero,
            'valor' => $this->valor,
            'max_cap' => $this->max_cap,
            'tipo_quartos_id' => $this->tipo_quartos_id,
        ];
    }
}
