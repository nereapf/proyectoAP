<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'nombre' => 'required|string|max:100|unique:productos,nombre',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'medidas' => 'required|string|max:255',
            'color' => 'required|string|max:100',
            'incremento' => 'required|numeric|min:0',
            'catalogo_id' => 'exists:catalogos,id',
            'materiales.*.material_id' => 'required|exists:materiales,id',
            'gastos.*.gasto_id' => 'required|exists:gastos_fabricacion,id',
            'gastos.*.horas' => 'required|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            "nombre.required" => "Debe introducir un nombre",
            "nombre.unique" => "Este material ya existe",
            "foto.required" => "Debe adjuntar una imágen",
            "foto.mimes" => "La imágen debe ser en formato jpeg,jpg o png",
            'foto.max' => 'La imagen no debe superar los 2MB',
            'medidas.required' => "Debe introducir un medida para el producto",
            'color.required' => "Debe introducir un color",
            "incremento.min" => "No puede ser un número negativo",
            "gastos.*.horas.min" => "No puede ser un número negativo"
        ];
    }
}
