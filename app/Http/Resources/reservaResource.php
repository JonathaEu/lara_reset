<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class reservaResource extends JsonResource
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
                'fk_cliente' => $this->fk_cliente,
                'fk_quarto' => $this->fk_quarto,
                'fk_funcionario' => $this->fk_funcionario,
                'fk_consumo' => $this->fk_consumo,
                'status' => $this->status,
                'dt_reserva' => $this->dt_reserva,
                'check_in' => $this->check_in,
                'check_out' => $this->check_out,
                'valor_diaria' => $this->valor_diaria,
            ];
    }
}
