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
        ]);

        if ($this->account_type == 'admin') {
            $this->merge([
                'department_id' => (int)$this->department_id,
                'section_id' => (int)$this->section_id
            ]);
        }

        if ($this->account_type == 'advisor') {
            $this->merge([
                'section_id' => (int)$this->section_id
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
                'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'],
                'birthday' => ['required', 'date:m/d/Y'],
                'account_type' => ['required', Rule::in(['admin', 'advisor', 'teacher', 'student'])],
                'department_id' => ['required_if:account_type,admin', 'exists:departments,id'],
                'section_id' => ['required_if:account_type,admin,advisor,student', 'exists:sections,id']
            ];
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'birthday' => ['required', 'date:m/d/Y'],
            'account_type' => ['required', Rule::in(['admin', 'advisor', 'teacher', 'student'])],
            'department_id' => ['required_if:account_type,admin', 'exists:departments,id'],
            'section_id' => ['required_if:account_type,admin,advisor,student', 'exists:sections,id']
        ];
    }
}
