<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
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
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:100',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'medidas' => 'required|string|max:255',
            'color' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'catalogo_id' => 'exists:catalogos,id',
        ];
    }

    public function messages(): array
    {
        return [
            "nombre.required" => "Debe introducir un nombre",
            "foto.mimes" => "La imágen debe ser en formato jpeg,jpg o png",
            'foto.max' => 'La imagen no debe superar los 2MB',
            'medidas.required' => "Debe introducir un medida para el producto",
            'color.required' => "Debe introducir un color",
            'precio.required' => 'Debe introducir un precio',
            'precio.numeric' => 'El precio debe ser un número',
            'precio.min" => "No puede ser un número negativo'
        ];
    }

}
