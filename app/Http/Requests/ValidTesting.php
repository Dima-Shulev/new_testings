<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidTesting extends FormRequest
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
            'name_test'=> ['required','string'],
            'content' => ['required','string'],
            'questions' => ['required'],
            'trueAnswers' =>['required'],
            'falseAnswers' => ['required'],
            'passing_score' => ['nullable','string'],
            'description' => ['required'],
            'created_at' => ['nullable','data']
        ];
    }
}
