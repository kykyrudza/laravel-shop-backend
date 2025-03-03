<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UserChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => $this->passwordRules(),
            'password' => array_merge($this->passwordRules(), ['confirmed']),
        ];
    }

    private function passwordRules(): array
    {
        return [
            'required',
            'string',
            'min:8',
            //        'regex:/[a-z]/',
            //        'regex:/[A-Z]/',
            //        'regex:/[0-9]/',
            //        'regex:/[@$!%*?&#]/',
        ];
    }
}
