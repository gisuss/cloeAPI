<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequests extends FormRequest
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
            'email_username' => 'username o correo electrónico',
            'password' => 'contraseña',
            'remember_me' => 'recuerdame',
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
            'email_username.required' => 'Necesitamos saber tu :attribute.',
            'email_username.max' => 'El campo de :attribute no debe exceder los 256 caracteres.',
            'email_username.regex' => 'El :attribute no tiene formato válido.',
            'password.required' => 'La :attribute es requerida.',
            'password.max' => 'La :attribute debe ser menor a 16 caracteres.',
            'remember_me.required' => 'El valor del campo :attribute es requerido.',
            'remember_me.boolean' => 'El valor del campo :attribute debe ser tipo booleano.',
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
            'email_username' => 'required|string|max:256|regex:/^[a-zA-Z@.0-9_-]+$/',
            'password' => 'required|string|max:16',
            // 'remember_me' => 'nullable|boolean',
        ];
    }

}
