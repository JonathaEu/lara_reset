<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
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
                'nome' => $this->nome,
                'cpf' => $this->cpf,
                'email' => $this->email,
                'senha' => $this->senha,
                'telefone' => $this->telefone,
            ];
    }
}
