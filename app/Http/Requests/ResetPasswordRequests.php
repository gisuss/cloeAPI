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
            'pin' => 'pin de restablecimiento de contraseña'
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
            'pin.required' => 'El :attribute es requerido.',
            'pin.string' => 'El :attribute debe ser de tipo string.',
            'pin.exists' => 'El :attribute no es válido, por favor genere una nueva solicitud.',
            'password.required' => 'La :attribute es requerida.',
            'password.min' => 'La :attribute debe contener al menos 8 caracteres.',
            'password.max' => 'La :attribute solo debe contener hasta 16 caracteres.',
            'confirm_password.required' => 'La :attribute es requerida.',
            'confirm_password.same' => 'Las contraseñas deben coincidir.',
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
            'pin' => 'required|string|exists:password_reset_tokens,token',
            'password' => [ 'required', 'min:8', 'max:16' ],
            'confirm_password' => 'required|same:password',
        ];
    }

}
