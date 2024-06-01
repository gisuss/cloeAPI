<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElementUpdateRequest extends FormRequest
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
            'name' => 'nombre del componente',
            'weight' => 'peso del componente',
            'dimensions' => 'dimensiones del componente',
            'reusable' => 'el componente es reusable?',
            'observations' => 'observaciones del componente',
            'materials' => 'materiales del componente',
            'process' => 'procesos de extracción del componente',
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
            'name.max' => 'El :attribute no debe exceder los 255 caracteres.',
            'weight.numeric' => 'El :attribute debe ser numérico.',
            'dimensions.string' => 'Las :attribute deben ser de tipo texto.',
            'reusable.boolean' => 'El campo :attribute debe ser verdadero o falso.',
            'observations.max' => 'Las :attribute no debe exceder los 255 caracteres.',
            'materials.array' => 'Los :attribute deben ir dentro de una lista.',
            'process.array' => 'Los :attribute deben ir dentro de una lista.',
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
            'name' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'dimensions' => 'nullable|string',
            'reusable' => 'nullable|boolean',
            'observations' => 'nullable|string|max:255',
            'materials' => 'nullable|array',
            'materials.*' => 'required|integer',
            'process' => 'nullable|array',
            'process.*' => 'required|integer',
        ];
    }
}
