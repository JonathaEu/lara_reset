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
            "clientes_id" => ['required'],
            "quartos_id" => ['required'],
            "users_id" => ['required'],
            "consumos_id" => ['required'],
            "status" => ['required'],
            "dt_inicial" => ['required'],
            "dt_final" => ['required'],
            "check_in" => ['required'],
            "check_out" => ['required'],
        ];
    }
}
