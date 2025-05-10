<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProyectoRequest extends FormRequest
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
            'empresa' => 'required|string|max:100',
            'precio' => 'required|numeric',
            'fotos_productos' => 'required|array',
            'fotos_productos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            "nombre.required" => "Debe introducir un nombre para el proyecto",
            "empresa.required" => "Debe introducir la empresa a la que va dirigida este proyecto",
            "precio.required" => "Debe introducir un precio",
            "fotos_productos.required" => "Debe seleccionar al menos un producto",
            "fotos_productos.*.image" => "El archivo debe ser una imagen",
            "fotos_productos.*.mimes" => "La imágen debe ser en formato jpeg,jpg o png",
        ];
    }

}
