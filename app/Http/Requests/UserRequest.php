<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => Str::lower($this->name),
            'account_type' => Str::lower($this->account_type),
            'gender' => Str::lower($this->gender)
        ]);


        if ($this->account_type == 'student') {
            $this->merge([
                'take_survey' => true,
            ]);
        }else {
            $this->merge([
                'take_survey' => false
            ]);
        }

        if ($this->account_type == 'admin') {
            $this->merge([
                'department_id' => filter_var($this->department_id, FILTER_SANITIZE_NUMBER_INT)

            ]);
        }

        if ($this->account_type !== 'teacher') {
            $this->merge([
                'section_id' => filter_var($this->section_id, FILTER_SANITIZE_NUMBER_INT)
            ]);
        }

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
                'name' => ['required', 'string', 'max:255'],
                // 'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'],
                'birthday' => ['required', 'date', 'date_format:Y-m-d'],
                'account_type' => ['required', Rule::in(['admin', 'advisor', 'teacher', 'student'])],
                'department_id' => ['required_if:account_type,admin', 'exists:departments,id'],
                'section_id' => ['required_if:account_type,admin,advisor,student', 'exists:sections,id'],
                'take_survey' => ['required', 'boolean'],
                'gender' => ['required', Rule::in(['male', 'female'])]
            ];
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'birthday' => ['required', 'date', 'date_format:Y-m-d'],
            'account_type' => ['required', Rule::in(['admin', 'advisor', 'teacher', 'student'])],
            'department_id' => ['required_if:account_type,admin', 'exists:departments,id'],
            'section_id' => ['required_if:account_type,admin,advisor,student', 'exists:sections,id'],
            'take_survey' => ['required', 'boolean'],
            'gender' => ['required', Rule::in(['male', 'female'])]

        ];
    }

    public function messages(): array
{
    return [
        'birthday.date_format' => 'The birthday field must match the format dd/mm/yyyy.',
    ];
}
}
