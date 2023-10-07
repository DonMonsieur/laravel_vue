<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $rules = [
            'name' => 'sometimes|string|max:25|unique:products,name,' . $this->id,
            'category' => 'sometimes|string|max:55|unique:products,category,' . $this->id,
            'description' => 'nullable|string',
        ];

        // Conditionally apply validation rules for images when changes are made
        if (!empty($this->input('images'))) {
            $rules['images'] = 'array|min:1';
            $rules['images.*'] = 'image|mimes:jpeg,jpg,png|max:10000';
        }

        return $rules;
    }
}
