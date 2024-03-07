<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaeeStoreRequest extends FormRequest
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
            'brand_id' => 'marca',
            'line_id' => 'línea',
            'category_id' => 'categoría',
            'model' => 'modelo',
            'information' => 'información adicional',
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
            'brand_id.required' => 'La :attribute es requerida.',
            'brand_id.numeric' => 'La :attribute debe ser numérica.',
            'brand_id.exists' => 'La :attribute es inválida.',
            'line_id.required' => 'La :attribute es requerida.',
            'line_id.numeric' => 'La :attribute debe ser numérica.',
            'line_id.exists' => 'La :attribute es inválida.',
            'category_id.required' => 'La :attribute es requerida.',
            'category_id.numeric' => 'La :attribute debe ser numérica.',
            'category_id.exists' => 'La :attribute es inválida.',
            'model.required' => 'El :attribute es requerido.',
            'model.max' => 'El :attribute no debe exceder los 255 caracteres.',
            'information.max' => 'El :attribute no debe exceder los 300 caracteres.',
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
            'brand_id' => 'required|numeric|exists:brands,id',
            'line_id' => 'required|numeric|exists:lines,id',
            'category_id' => 'required|numeric|exists:categories,id',
            'model' => 'required|string|max:255',
            'information' => 'nullable|string|max:300',
        ];
    }
}
