<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCategory extends FormRequest
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
            'name' => ['required','string','min:3','max:100'],
            'content' => ['nullable','string'],
            'metaKey' => ['nullable','string','min:5'],
            'metaDescription' => ['nullable','string','min:10','max:120'],
            'created_at' => ['nullable','string'],
            'url'=> ['nullable','string']
        ];
    }
}
