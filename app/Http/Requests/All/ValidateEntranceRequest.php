<?php

namespace App\Http\Requests\All;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class ValidateEntranceRequest extends FormRequest
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
            'email' => ['required','email','min:10','max:100'],
            'password' => ['required', 'min:8'],
                /*Password::min(8)*/
               /* ->mixedCase()
                ->numbers()
                ->symbols()],*/
            'remember' => ['nullable','string'],
        ];
    }

}
