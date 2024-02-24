<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidUserRequest extends FormRequest
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
            'name' => ['required','string','min:3','max:50'],
            'email' => ['required','email','min:10','max:100'],
            'password' => ['required', 'min:8'],
                /*Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],*/
            'status' => ['required','string'],
            'created_at' => ['required'],
            'balance' => ['required','int']
        ];
    }
}
