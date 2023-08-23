<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservaRequest extends FormRequest
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
            "status" => ['required'],
            "dt_inicial" => ['required'],
            "dt_final" => ['required'],
            "valor_diaria" => ['required'],
            "fk_cliente" => ['required'],
            "fk_quarto" => ['required'],
            "fk_funcionario" => ['required'],
            "fk_consumo" => ['required'],
        ];
    }
}