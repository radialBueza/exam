<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ExamRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => Str::lower($this->name),
            'subject_id' => (int)$this->subject_id,
            'grade_level_id' => (int)$this->grade_level_id,
            'num_of_questions' => (int)$this->num_of_questions,
            'time_limit' => (int)$this->time_limit
        ]);

    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::user() == 'admin') {
            return true;
        }

        if ($this->isMethod('post')) {
            return true;
        }

        if (Auth::id() == $this->exam->user_id) {
            return true;
        }

        return false;
        // return (Auth::user()->account_type == 'admin' || Auth::user()->account_type == 'student' || Auth::user()->account_type == 'advisor');
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
                'name' => ['unique:App\Models\Exam,name', 'min:4', 'max:35', 'required'],
                'subject_id' => ['required', 'exists:subjects,id'],
                'grade_level_id' => ['required', 'exists:grade_levels,id'],
                'description' => ['required'],
                'num_of_questions' => ['required', 'integer','gte:10'],
                'time_limit' => ['required', 'integer', 'gte:10']
            ];
        }

        return [
            'name' => [Rule::unique('exams')->ignore($this->exam), 'min:4', 'max:35', 'required'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'grade_level_id' => ['required', 'exists:grade_levels,id'],
            'description' => ['required'],
            'num_of_questions' => ['required', 'integer','gte:10'],
            'time_limit' => ['required', 'integer', 'gte:10']
        ];
    }
}
