<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Store extends FormRequest
{
    // Lower strings

    protected function prepareForValidation(): void
    {
        // $this->merge([
        //     'name' => Str::lower($this->name)
        // ]);
        if ($this->has('name')) {
            $this->merge([
                'name' => Str::lower($this->name)
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
        return [
            'name' => ['unique:App\Models\Department,name', 'min:4', 'max:20', ]
        ];
    }


}
