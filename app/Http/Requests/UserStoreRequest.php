<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'email' => 'correo electrónico',
            'address' => 'dirección',
            'role' => 'rol',
            'ci_type' => 'tipo de documento de identificación',
            'ci_number' => 'número del documento de identificación',
            'estado_id' => 'identificador de estado',
            'municipio_id' => 'identificador de municipio',
            'centro_id' => 'identificador de centro de acopio',
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
            'address.required' => 'La :attribute es requerida.',
            'address.max' => 'La :attribute debe ser menor a 255 caracteres.',
            'role.required' => 'El :attribute es requerido.',
            'role.exists' => 'El :attribute es inválido.',
            'ci_type.required' => 'El :attribute es requerido.',
            'ci_type.in' => 'El :attribute debe ser V, E, P, J o G.',
            'ci_number.required' => 'El :attribute es requerido.',
            'ci_number.min' => 'El :attribute debe tener al menos 7 dígitos.',
            'ci_number.max' => 'El :attribute no debe exceder los 9 dígitos.',
            'estado_id.required' => 'El :attribute es requerido.',
            'estado_id.numeric' => 'El :attribute debe ser numérico.',
            'estado_id.exists' => 'El :attribute es inválido.',
            'ciudad_id.required' => 'El :attribute es requerido.',
            'ciudad_id.numeric' => 'El :attribute debe ser numérico.',
            'ciudad_id.exists' => 'El :attribute es inválido.',
            'centro_id.numeric' => 'El :attribute debe ser numérico.',
            'centro_id.exists' => 'El :attribute es inválido.',
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
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|string|exists:roles,name',
            'ci_type' => 'required|in:V,E,P,J,G',
            'ci_number' => [
                'required',
                'string',
                'min:7',
                'max:9',
                Rule::unique('identifications', 'number')->where(fn ($query) => $query->where('type', request()->ci_type))
            ],
            'estado_id' => 'required|numeric|exists:estados,id',
            'municipio_id' => 'required|numeric|exists:municipios,id',
            'centro_id' => 'nullable|numeric|exists:centro_acopios,id',
          ];
    }
}
