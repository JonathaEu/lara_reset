<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'nome' => ['required'],
            'cpf' => ['required'],
            'nascimento' => ['required'],
            'email' => ['required'],
            //'email' => ['required','unique:funcionario'. $this->funcionario->id, 'max:60'],
            'telefone' => ['required',],
            'cidade' => ['required',],
            'estado' => ['required']
        ];
    }
}
