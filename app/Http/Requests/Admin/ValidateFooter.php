<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidateFooter extends FormRequest
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
            'url' => ['nullable','string'],
            'content' => ['nullable','string'],
            'metaKey' => ['nullable','string','min:5'],
            'metaDescription' => ['nullable','string','max:120'],
            'created_at' => ['nullable','date'],
            'position'=> ['nullable','string']
        ];
    }
}
