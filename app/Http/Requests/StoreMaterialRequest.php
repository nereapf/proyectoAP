<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialRequest extends FormRequest
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
            'nombre' => 'required|string|max:100|unique:productos,nombre',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'precio_m2' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            "nombre.required" => "Debe introducir un nombre",
            "nombre.unique" => "Este material ya existe",
            "foto.required" => "Debe adjuntar una imágen",
            "foto.mimes" => "La imágen debe ser en formato jpeg,jpg o png",
            "foto.max" => "La imagen no debe superar los 2MB",
            "precio_m2.required" => "Debe introducir un precio",
            "precio_m2.min" => "No puede ser un número negativo"
        ];
    }
}

