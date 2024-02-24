<?php

namespace App\Http\Requests\All;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ValidateRegisterRequest extends FormRequest
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
                'email' => ['required','email','unique:users,email','string','min:10','max:50'],
                'password' => ['required','confirmed', 'min:8'],
                /*Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],*/
                'politic' => ['required'],
                'avatar' => ['nullable','image',File::image()
                    ->min('1kb')
                    ->max('10000000kb')
                ]
        ];
    }
}
