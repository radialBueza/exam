<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if ($this->isMethod('put')) {
            $this->merge([
                'has_question_file' => filter_var($this->has_question_file, FILTER_VALIDATE_BOOLEAN),
                'has_a_file' => filter_var($this->has_a_file, FILTER_VALIDATE_BOOLEAN),
                'has_b_file' => filter_var($this->has_b_file, FILTER_VALIDATE_BOOLEAN),
                'has_c_file' => filter_var($this->has_c_file, FILTER_VALIDATE_BOOLEAN),
                'has_d_file' => filter_var($this->has_d_file, FILTER_VALIDATE_BOOLEAN),
            ]);
        }

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

        if ($this->isMethod('post')) {
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

        return [
            'question' => ['nullable', Rule::requiredIf(function() {
                return $this->question_file === null && $this->has_question_file=== false;
            }), 'min:4'],
            'question_file' => ['nullable', Rule::requiredIf(function() {
                return $this->question === null && $this->has_question_file === false;
            }), 'mimes:jpg,jpeg,png'],
            'a' => ['nullable', Rule::requiredIf(function() {
                return $this->a_file === null && $this->has_a_file=== false;
            }), 'min:4'],
            'a_file' => ['nullable', Rule::requiredIf(function() {
                return $this->a === null && $this->has_a_file === false;
            }), 'mimes:jpg,jpeg,png'],
            'b' => ['nullable', Rule::requiredIf(function() {
                return $this->b_file === null && $this->has_b_file=== false;
            }), 'min:4'],
            'b_file' => ['nullable', Rule::requiredIf(function() {
                return $this->b === null && $this->has_b_file=== false;
            }), 'mimes:jpg,jpeg,png'],
            'c' => ['nullable', Rule::requiredIf(function() {
                return $this->c_file === null && $this->has_c_file=== false;
            }), 'min:4'],
            'c_file' => ['nullable', Rule::requiredIf(function() {
                return $this->c === null && $this->has_c_file=== false;
            }), 'mimes:jpg,jpeg,png'],
            'd' => ['nullable', Rule::requiredIf(function() {
                return $this->d_file === null && $this->has_d_file=== false;
            }), 'min:4'],
            'd_file' => ['nullable', Rule::requiredIf(function() {
                return $this->d === null && $this->has_d_file=== false;
            }), 'mimes:jpg,jpeg,png'],
            'correct_answer' => ['required', Rule::in(['a','b','c','d'])]
        ];
    }
}
