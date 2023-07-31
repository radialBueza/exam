<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GradeLevelRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'department_id' => (int)$this->department_id,
            'name' => Str::lower($this->name),
            'show' => filter_var($this->show, FILTER_VALIDATE_BOOLEAN)
        ]);
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->account_type == 'admin';
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
                'department_id' => ['required', 'exists:departments,id'],
                'name' => ['unique:App\Models\GradeLevel,name', 'min:4', 'max:20', 'required']
            ];
        }

        return [
            'department_id' => ['required', 'exists:departments,id'],
            'name' => [Rule::unique('grade_levels')->ignore($this->gradeLevel), 'min:4', 'max:20', ]
        ];
    }
}
