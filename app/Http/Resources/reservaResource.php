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
                'users_id' => $this->users_id,
                'consumos_id' => $this->consumos_id,
                'status' => $this->status,
                'dt_inicial' => $this->dt_inicial,
                'dt_final' => $this->dt_final,
                'check_in' => $this->check_in,
                'check_out' => $this->check_out,
            ];
    }
}
