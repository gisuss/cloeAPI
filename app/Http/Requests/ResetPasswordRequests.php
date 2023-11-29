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
            'password' => 'contraseña',
            'confirm_password' => 'confirmación de contraseña',
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
            'password.max' => 'La :attribute debe ser menor a 16 caracteres.',
            'confirm_password.required' => 'La :attribute es requerido.',
            'confirm_password.same' => 'La :attribute debe ser igual al valor del campo de contraseña.',
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
            'password' => [
                'required',
                'max:16',
                Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(),
            ],
            'confirm_password' => 'required|same:password',
        ];
    }

}
