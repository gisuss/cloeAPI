<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CentroAcopioStoreRequest extends FormRequest
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
            'municipio_id' => 'identificador de municipio',
            'description' => 'descripción del centro de acopio',
            'name' => 'nombre del centro de acopio',
            'address' => 'dirección del centro de acopio',
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
            'municipio_id.required' => 'El :attribute es requerido.',
            'municipio_id.numeric' => 'El :attribute debe ser numérico.',
            'municipio_id.exists' => 'El :attribute es inválido.',
            'address.required' => 'La :attribute es requerida.',
            'address.string' => 'La :attribute debe ser de tipo texto.',
            'address.max' => 'La :attribute no debe superar los 300 caracteres.',
            'description.string' => 'La :attribute debe ser de tipo texto.',
            'description.max' => 'La :attribute no debe superar los 300 caracteres.',
            'name.string' => 'El :attribute debe ser de tipo texto.',
            'name.max' => 'El :attribute no debe superar los 150 caracteres.',
            'name.unique' => 'El :attribute ya está en uso.',
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
            'encargado_id' => 'required|numeric|exists:users,id',
            'estado_id' => 'required|numeric|exists:estados,id',
            'municipio_id' => 'required|numeric|exists:municipios,id',
            'name' => 'required|string|max:150|unique:centro_acopios,name',
            'description' => 'nullable|string|max:300',
            'address' => 'required|string|max:300',
        ];
    }
}
