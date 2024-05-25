<?php

namespace App\Http\Requests;

use App\Models\{Identification, User};
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
            'name' => 'nombre',
            'lastname' => 'apellido',
            'address' => 'dirección',
            'ci_type' => 'tipo de documento de identificación',
            'ci_number' => 'número del documento de identificación',
            'estado_id' => 'identificador de estado',
            'municipio_id' => 'identificador de municipio',
            'centro_id' => 'identificador de centro de acopio',
            'active' => 'actividad de usuario',
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
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $identification = Identification::find(User::find($this->user)->ci_id);
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
                Rule::unique('identifications', 'number')->where(fn ($query) => $query->where('type', request()->ci_type))->ignore($identification)
            ],
            'estado_id' => 'nullable|numeric|exists:estados,id',
            'municipio_id' => 'nullable|numeric|exists:municipios,id',
            'centro_id' => 'nullable|numeric|exists:centro_acopios,id',
            'active' => 'nullable|numeric|regex:/^[10]$/'
        ];
    }
}
