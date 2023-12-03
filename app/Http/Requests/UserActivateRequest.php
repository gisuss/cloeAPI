<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserActivateRequest extends FormRequest
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
            'role' => 'nombre del nuevo rol',
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
            'role.required' => 'El :attribute es requerido.',
            'role.exists' => 'El :attribute no es válido.',
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
            'role' => 'required|string|exists:roles,name',
        ];
    }
}
