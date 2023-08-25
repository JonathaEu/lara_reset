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
                'clientes_id' => $this->clientes_id,
                'quartos_id' => $this->quartos_id,
                'funcionarios_id' => $this->funcionarios_id,
                'consumos_id' => $this->consumos_id,
                'status' => $this->status,
                'dt_reserva' => $this->dt_reserva,
                'check_in' => $this->check_in,
                'check_out' => $this->check_out,
                'valor_diaria' => $this->valor_diaria,
            ];
    }
}
