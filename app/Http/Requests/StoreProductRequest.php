<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'category' => 'required|string|max:55',
            'description' => 'required|string',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,jpg,png|max:10000',
        ];
    }
}
