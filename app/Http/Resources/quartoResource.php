<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class quartoResource extends ResourceCollection
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
            'fk_tipo_qrt' => $this->fk_tipo_qrt,
            'fk_cliente' => $this->fk_cliente,
            'fk_frigobar' => $this->fk_frigobar,
            'fk_estacionamento' => $this->fk_estacionamento,
        ];
    }
}
