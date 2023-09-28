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
            'name' => Str::lower($this->name),
            'department_id' => filter_var($this->department_id, FILTER_SANITIZE_NUMBER_INT),
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
                'name' => ['unique:App\Models\GradeLevel,name', 'min:4', 'max:35', 'required']
            ];
        }

        return [
            'department_id' => ['required', 'exists:departments,id'],
            'name' => [Rule::unique('grade_levels')->ignore($this->gradeLevel), 'min:4', 'max:35', 'required']
        ];
    }
}
