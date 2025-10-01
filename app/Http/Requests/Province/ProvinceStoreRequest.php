<?php

namespace App\Http\Requests\Province;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceStoreRequest extends FormRequest
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
             * The name of the province.
             * 
             * @example Valle del cauca
             */
            'name' => ['required', 'string', 'max:255', 'unique:provinces,name'],
        ];
    }
}
