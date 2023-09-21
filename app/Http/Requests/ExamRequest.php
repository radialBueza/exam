<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class ExamRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => Str::lower($this->name),
            // 'subject_id' => (int)$this->subject_id,
            // 'grade_level_id' => $this->grade_level_id !== null ? (int)$this->grade_level_id : null,
            // 'num_of_questions' => (int)$this->num_of_questions,
            // 'time_limit' => (int)$this->time_limit
            'subject_id' => filter_var($this->subject_id, FILTER_SANITIZE_NUMBER_INT),
            'grade_level_id' => $this->grade_level_id !== null ? filter_var($this->grade_level_id, FILTER_SANITIZE_NUMBER_INT) : null,
            'num_of_questions' => filter_var($this->num_of_questions, FILTER_SANITIZE_NUMBER_INT),
            'time_limit' => filter_var($this->time_limit, FILTER_SANITIZE_NUMBER_INT)
        ]);

    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::user()->account_type == 'admin') {
            return true;
        }

        if ($this->isMethod('post') && Auth::user()->account_type != 'admin') {
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
                'grade_level_id' => ['nullable', 'exists:grade_levels,id'],
                'description' => ['required'],
                'num_of_questions' => ['required', 'integer','gte:10'],
                'time_limit' => ['required', 'integer', 'gte:10']
            ];
        }

        return [
            'name' => [Rule::unique('exams')->ignore($this->exam), 'min:4', 'max:35', 'required'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'grade_level_id' => ['nullable', 'exists:grade_levels,id'],
            'description' => ['required'],
            'num_of_questions' => ['required', 'integer','gte:10'],
            'time_limit' => ['required', 'integer', 'gte:10']
        ];
    }
}
