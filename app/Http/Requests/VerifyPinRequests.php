<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyPinRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the error attributes for the defined validation messages.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'correo electrónico',
            'pin' => 'PIN de validacón',
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
            'email.required' => 'Necesitamos saber tu :attribute.',
            'email.max' => 'El campo de :attribute no debe exceder los 256 caracteres.',
            'email.email' => 'El campo de :attribute no es válido.',
            'pin.regex' => 'El :attribute no tiene formato válido.',
            'pin.required' => 'El :attribute es requerido.',
            'pin.max' => 'El :attribute no debe exceder 6 dígitos neméricos.',
            'pin.min' => 'El :attribute debe contener 6 dígitos numéricos.',
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
            'email' => 'required|string|email|max:256',
            'pin' => 'required|string|min:6|max:6|regex:/^[0-9]{6}$/',
        ];
    }

}
