<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'nombre',
            'phone' => 'teléfono',
            'estado_id' => 'identificador de estado',
            'ciudad_id' => 'identificador de ciudad',
            'message' => 'mensaje',
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
            'name.required' => 'El :attribute es requerido.',
            'phone.required' => 'El :attribute es requerido.',
            'estado_id.required' => 'La :attribute es requerido.',
            'estado_id.exists' => 'El :attribute no es válido.',
            'estado_id.numeric' => 'El :attribute debe ser numérico.',
            'ciudad_id.required' => 'La :attribute es requerido.',
            'ciudad_id.exists' => 'El :attribute no es válido.',
            'ciudad_id.numeric' => 'El :attribute debe ser numérico.',
            'message.required' => 'El :attribute es requerido.',
            'email.required' => 'Necesitamos saber tu :attribute.',
            'email.max' => 'El :attribute no debe exceder los 255 caracteres.',
            'email.email' => 'El :attribute no tiene formato válido.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|max:255|email',
            'estado_id' => 'required|numeric|exists:estados,id',
            'ciudad_id' => 'required|numeric|exists:ciudades,id',
            'message' => 'required|string|max:300'
        ];
    }
}
