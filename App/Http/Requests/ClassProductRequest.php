<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $classId = $this->route('id') ?? null;

        return [
            'nombreClase' => [
                'required',
                'string',
                'max:50',
                Rule::unique('claseproducto', 'nombreClase')->ignore($classId, 'idClaseProducto')
            ]
        ];
    }

    public function messages()
    {
        return [
            'nombreClase.required' => 'El nombre de la clase es obligatorio',
            'nombreClase.unique' => 'Esta clase de producto ya existe',
            'nombreClase.max' => 'El nombre no puede exceder los 50 caracteres'
        ];
    }
}