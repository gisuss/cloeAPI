<?php

namespace App\Http\Requests;

use App\Models\{Identification, User};
use App\Rules\MatchPasswordRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
            'name' => 'nombre',
            'lastname' => 'apellido',
            'address' => 'dirección',
            'ci_type' => 'tipo de documento de identificación',
            'ci_number' => 'número del documento de identificación',
            'estado_id' => 'identificador de estado',
            'ciudad_id' => 'identificador de ciudad',
            'centro_id' => 'identificador de centro de acopio',
            'active' => 'actividad de usuario',
            'role' => 'rol de usuario',
            'old_password' => 'contraseña actual',
            'password' => 'nueva contraseña',
            'confirm_password' => 'confirmación de nueva contraseña',
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
            'address.required' => 'La :attribute es requerido.',
            'address.max' => 'El :attribute debe ser menor a 255 caracteres.',
            'address.regex' => 'La :attribute solo debe contener letras y espacios.',
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
            'active.numeric' => 'El valor de campo :attribute debe ser 1 o 0.',
            'active.regex' => 'El valor de campo :attribute es inválido.',
            'password.required' => 'La :attribute es requerida.',
            'old_password.min' => 'La :attribute debe contener al menos 8 caracteres.',
            'old_password.max' => 'La :attribute solo debe contener hasta 16 caracteres.',
            'old_password.current_password' => 'La :attribute no es correcta.',
            'password.min' => 'La :attribute debe contener al menos 8 caracteres.',
            'password.max' => 'La :attribute solo debe contener hasta 16 caracteres.',
            'confirm_password.required' => 'La :attribute es requerida.',
            'confirm_password.same' => 'Las contraseñas deben coincidir.',
            'role.exists' => 'El :attribute no es válido.',
            'role.string' => 'El :attribute debe ser de tipo string.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // $identification = Identification::find(User::find($this->user)->ci_id);
        return [
            'name' => 'nullable|string|max:255|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'nullable|string|max:255|regex:/^[\pL\s\-]+$/u',
            'address' => 'nullable|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => ['nullable', 'max:256', Rule::unique('users','email')->ignore($this->user)],
            'ci_type' => 'nullable|in:V,E,P,J,G',
            'ci_number' => [
                'nullable',
                'string',
                'min:7',
                'max:9',
                'unique:users,email,' . auth()->user()->id . ',' . 'id',
            ],
            'estado_id' => 'nullable|numeric|exists:estados,id',
            'ciudad_id' => 'nullable|numeric|exists:ciudades,id',
            'centro_id' => 'nullable|numeric|exists:centro_acopios,id',
            'active' => 'nullable|numeric|regex:/^[10]$/',
            'role' => 'nullable|string|exists:roles,name',
            'old_password' => ['nullable', new MatchPasswordRule],
            'password' => 'nullable|min:8|max:16',
            'confirm_password' => 'nullable|same:password',
        ];
    }
}
