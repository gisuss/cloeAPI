<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'email' => 'correo electrónico',
            'role' => 'cargo',
            'name' => 'nombre',
            'lastname' => 'apellido',
            'dni' => 'documento de identificación',
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
            'email.max' => 'El :attribute debe ser menor a 256 caracteres.',
            'email.unique' => 'El :attribute ya está registrado.',
            'name.required' => 'El :attribute es requerido.',
            'name.max' => 'El :attribute debe ser menor a 255 caracteres.',
            'name.regex' => 'El :attribute solo debe contener letras y espacios.',
            'lastname.required' => 'El :attribute es requerido.',
            'lastname.max' => 'El :attribute debe ser menor a 255 caracteres.',
            'lastname.regex' => 'El :attribute solo debe contener letras y espacios.',
            'role.required' => 'El :attribute es requerido.',
            'role.string' => 'El :attribute debe ser de tipo string.',
            'role.exists' => 'El :attribute no es válido.',
            'dni.required' => 'El :attribute es requerido.',
            'dni.regex' => 'El :attribute no tiene formato válido.',
            'dni.unique' => 'El :attribute ya está registrado.',
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
            'dni' => ['required', 'string', 'regex:/^[V|E|J|G][0-9]{6,9}$/', Rule::unique('users','dni')->ignore($this->user)],
            'email' => ['required', 'max:256', Rule::unique('users','email')->ignore($this->user)],
            'role' => 'required|string|exists:roles,name',
        ];
    }
}
