<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'roleName' => 'nombre de rol',
            'estado_id' => 'identificador de estado',
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
            'roleName.required' => 'El :attribute es requerido.',
            'roleName.exists' => 'El :attribute no es válido.',
            'estado_id.required' => 'El :attribute es requerido.',
            'estado_id.numeric' => 'El :attribute debe ser numérico.',
            'estado_id.exists' => 'El :attribute es inválido.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'roleName' => 'required|string|exists:roles,name',
            'estado_id' => 'required|numeric|exists:estados,id'
        ];
    }
}
