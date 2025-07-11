<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => Str::lower($this->name),
            'grade_level_id' => filter_var($this->grade_level_id, FILTER_SANITIZE_NUMBER_INT),
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
                'grade_level_id' => ['required', 'exists:grade_levels,id'],
                'name' => ['unique:App\Models\Section,name', 'min:4', 'max:35', 'required']
            ];
        }

        return [
            'grade_level_id' => ['required', 'exists:departments,id'],
            'name' => [Rule::unique('sections')->ignore($this->section), 'min:4', 'max:35', 'required']
        ];
    }
}
