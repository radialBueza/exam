<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DepartmentChild extends FormRequest
{

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => Str::lower($this->name),
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
                'name' => ['unique:App\Models\GradeLevel,name', 'min:4', 'max:35', 'required']
            ];
        }

        return [
            'name' => [Rule::unique('grade_levels')->ignore($this->gradeLevel), 'min:4', 'max:35', 'required']
        ];
    }
}
