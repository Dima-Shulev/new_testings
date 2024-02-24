<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ValidEditRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','min:2','max:50','string'],
            'email' => ['required','email','string','min:10','max:50'],
            'id' => ['nullable'],
            'avatar' => ['nullable','image',File::image()
                ->min('1kb')
                ->max('10000000kb')
            ]
        ];
    }
}
