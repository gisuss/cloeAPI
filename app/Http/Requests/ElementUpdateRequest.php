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
            'observations' => 'nullable|string|max:255'
        ];
    }
}
