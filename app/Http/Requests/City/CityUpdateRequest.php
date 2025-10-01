<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

class CityUpdateRequest extends FormRequest
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
        $cityId = request()->route('city')->id;
        return [
            /**
             * The name of the city.
             * 
             * @example Cali
             */
            'name' => ['required', 'string', 'max:255', 'unique:cities,name,' . $cityId],
        ];
    }
}
