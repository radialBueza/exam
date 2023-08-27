<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'correct_answer' => Str::lower($this->correct_answer)
        ]);
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::id() == $this->exam->user_id || Auth::user()->account_type == 'admin') {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'question' => ['nullable', 'required_if:question_file,null', 'min:4'],
            'question_file' => ['nullable', 'required_if:question,null', 'mimes:jpg,jpeg,png'],
            'a' => ['nullable', 'required_if:a_file,null', 'min:4'],
            'a_file' => ['nullable', 'required_if:a,null', 'mimes:jpg,jpeg,png'],
            'b' => ['nullable', 'required_if:b_file,null', 'min:4'],
            'b_file' => ['nullable', 'required_if:b,null', 'mimes:jpg,jpeg,png'],
            'c' => ['nullable', 'required_if:c_file,null', 'min:4'],
            'c_file' => ['nullable', 'required_if:c,null', 'mimes:jpg,jpeg,png'],
            'd' => ['nullable', 'required_if:d_file,null', 'min:4'],
            'd_file' => ['nullable', 'required_if:d,null', 'mimes:jpg,jpeg,png'],
            'correct_answer' => ['required', Rule::in(['a','b','c','d'])]
        ];
    }

}
