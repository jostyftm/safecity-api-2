<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
             * The first name of the user.
             * 
             * example John
             */
            'name' => ['required', 'string', 'max:255'],

            /**
             * The last name of the user.
             *
             * example Doe
             */
            'last_name' => ['required', 'string', 'max:255'],


            /**
             * The email address of the user.
             *
             * example user@example.com
             */
            'email' => ['required', 'string', 'email', 'max:255'],

            /**
             * The password for the user.
             *
             * example Password123
             */
            'password' => ['required', 'string', 'confirmed'],
        ];
    }
}
