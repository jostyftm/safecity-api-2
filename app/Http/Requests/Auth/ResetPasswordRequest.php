<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            /**
             * The password reset token.
             * 
             * example ojfoidsjfdsoijfoidsjj
             */
            'token' => ['required', 'string'],

            /**
             * The email address of the user resetting the password.
             * 
             * example user@example.com
             */
            'email' => ['required', 'string', 'email', 'max:255'],

            /**
             * The new password for the user.
             * 
             * example Password123
             */
            'password' => ['required', 'string', 'confirmed'],
        ];
    }
}
