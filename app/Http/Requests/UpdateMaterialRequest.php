<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialRequest extends FormRequest
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
            'nombre' => 'string|max:100',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'precio_m2' => 'numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            "foto.mimes" => "La imágen debe ser en formato jpeg,jpg o png",
            "precio_m2.min" => "No puede ser un número negativo"
        ];
    }

}
