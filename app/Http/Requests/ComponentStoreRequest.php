<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComponentStoreRequest extends FormRequest
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
            'raee_id' => ['required', 'numeric', 'exists:raees,id'],
            'components' => ['required', 'array', 'min:1'],
            'components.*.name' => ['required', 'string'],
            'components.*.weight' => ['required', 'numeric'],
            'components.*.dimensions' => ['required', 'string'],
            'components.*.observations' => ['nullable', 'string', 'max:300'],
            'components.*.reusable' => ['required', 'boolean'],
            'components.*.materials' => ['required', 'array', 'min:1'],
            'components.*.materials.*' => ['required', 'integer', 'exists:materials,id'],
            'components.*.process' => ['required', 'array', 'min:1'],
            'components.*.process.*' => ['required', 'integer', 'exists:procesos,id'],
        ];
    }
}
