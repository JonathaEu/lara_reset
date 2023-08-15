<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuartoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'id' => ['required'],
            'nome' => ['required'],
            'numero' => ['required'],
            'valor' => ['required'],
            'max_cap' => ['required'],
            'quarto_id' => ['required'],
            // 'fk_tipo_qrt' => ['required'],
            // 'fk_cliente' => ['required'],
            // 'fk_frigobar' => ['required'],
            // 'fk_estacionamento' => ['required'],
        ];
    }
}
