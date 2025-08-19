<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropertyFormRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:255',
            'description' => 'string',
            'surface' => 'required|integer|min:1', 
            'bedrooms' => 'required|integer|min:0|max:100',  
            'rooms' => 'required|integer|min:0|max:100',    
            'floor' => 'nullable|integer|min:0|max:200',     
            'price' => 'required|integer|min:0', 
            'city' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'postal_code' => 'required|string|max:20',
            'sold' => 'boolean',
            'options' => 'array|exists:options,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'images' => 'nullable', 
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'sold' => (bool)$this->input('sold', false)
        ]);
    }
}
