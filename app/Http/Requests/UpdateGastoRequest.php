<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGastoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'precio_hora' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            "nombre.required" => "Debe introducir un nombre",
            "precio_hora.required" => "Debe introducir un precio",
            "precio_hora.min" => "No puede ser un número negativo"
        ];
    }

}

