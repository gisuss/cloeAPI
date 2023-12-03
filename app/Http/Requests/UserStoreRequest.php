<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
            'name' => 'nombre',
            'lastname' => 'apellido',
            'dni' => 'documento de identificación',
            'email' => 'correo electrónico',
            'role' => 'rol',
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
            'email.required' => 'El :attribute es requerido.',
            'email.email' => 'El :attribute no tiene formato válido.',
            'email.unique' => 'El :attribute ya se encuentra registrado, pruebe con uno correcto.',
            'email.max' => 'El :attribute debe ser menor a 255 caracteres.',
            'name.required' => 'El :attribute es requerido.',
            'name.max' => 'El :attribute debe ser menor a 255 caracteres.',
            'name.regex' => 'El :attribute solo debe contener letras y espacios.',
            'lastname.required' => 'El :attribute es requerido.',
            'lastname.max' => 'El :attribute debe ser menor a 255 caracteres.',
            'lastname.regex' => 'El :attribute solo debe contener letras y espacios.',
            'role.required' => 'El :attribute es requerido.',
            'role.exists' => 'El :attribute es inválido.',
            'dni.required' => 'El :attribute es requerido.',
            'dni.unique' => 'El :attribute ya está registrado.',
            'dni.regex' => 'El :attribute no tiene formato válido.',
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
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|string|exists:roles,name',
            'dni' => ['required', 'string', 'regex:/^[V|E|J|G][0-9]{6,10}$/', 'unique:users,dni'],
            'password' => [
				'required',
				'max:16',
				Password::min(8)
						// ->mixedCase()
						->letters()
						// ->numbers()
						// ->symbols()
						// ->uncompromised(),
            ],
            'confirm_password' => 'required|same:password',
          ];
    }
}
