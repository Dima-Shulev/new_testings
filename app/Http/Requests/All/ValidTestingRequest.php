<?php

namespace App\Http\Requests\All;

use Illuminate\Foundation\Http\FormRequest;

class ValidTestingRequest extends FormRequest
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
            'created_at' => ['nullable','data'],
            'show_answers' => ['nullable','string'],
            'time' => ['nullable','int']
        ];
    }
}
