<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CentroAcopioUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        return [
            'encargado_id' => 'identificador del encargado',
            'estado_id' => 'identificador de estado',
            'ciudad_id' => 'identificador de ciudad',
            'description' => 'descripción del centro de acopio',
            'address' => 'dirección del centro de acopio',
            'name' => 'nombre del centro de acopio',
            'active' => 'está activo el centro de acopio?',
        ];
    }

    /**
     * Get the error message for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'encargado_id.required' => 'El :attribute es requerido.',
            'encargado_id.numeric' => 'El :attribute debe ser numérico.',
            'encargado_id.exists' => 'El :attribute es inválido.',
            'estado_id.required' => 'El :attribute es requerido.',
            'estado_id.numeric' => 'El :attribute debe ser numérico.',
            'estado_id.exists' => 'El :attribute es inválido.',
            'ciudad_id.required' => 'El :attribute es requerido.',
            'ciudad_id.numeric' => 'El :attribute debe ser numérico.',
            'ciudad_id.exists' => 'El :attribute es inválido.',
            'address.required' => 'La :attribute es requerida.',
            'address.string' => 'La :attribute debe ser de tipo texto.',
            'address.max' => 'La :attribute no debe superar los 300 caracteres.',
            'description.string' => 'La :attribute debe ser de tipo texto.',
            'description.max' => 'La :attribute no debe superar los 300 caracteres.',
            'name.string' => 'El :attribute debe ser de tipo texto.',
            'name.max' => 'El :attribute no debe superar los 150 caracteres.',
            'name.unique' => 'El :attribute ya está en uso.',
            'active.boolean' => 'El campo :attribute debe ser de tipo booleano.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'encargado_id' => 'nullable|numeric|exists:users,id',
            'estado_id' => 'nullable|numeric|exists:estados,id',
            'ciudad_id' => 'nullable|numeric|exists:ciudades,id',
            'name' => 'nullable|string|max:150|unique:centro_acopios,name,except,id',
            'description' => 'nullable|string|max:300',
            'address' => 'nullable|string|max:300',
            'active' => 'nullable|boolean',
        ];
    }
}
