<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequests extends FormRequest
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
            'password' => 'nueva contraseña',
            'confirm_password' => 'confirmación de nueva contraseña',
            'token_url' => 'token de verificación',
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
            'password.required' => 'La :attribute es requerida.',
            'password.min' => 'La :attribute debe contener al menos 8 caracteres.',
            'password.max' => 'La :attribute solo debe contener hasta 16 caracteres.',
            'confirm_password.required' => 'La :attribute es requerida.',
            'confirm_password.same' => 'Las contraseñas deben coincidir.',
            'token_url.required' => 'El :attribute es requerido.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'password' => [ 'required', 'min:8', 'max:16' ],
            'confirm_password' => 'required|same:password',
            // 'token_url' => 'required|string',
        ];
    }

}
