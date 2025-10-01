<?php

namespace App\Http\Requests\Incident;

use Illuminate\Foundation\Http\FormRequest;

class IncidentUpdateRequest extends FormRequest
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
             * The title of the incident.
             * 
             * @example Help needed
             */
            'title' => ['required', 'string', 'max:255'],

            /**
             * The category of the incident.
             * 
             * @example 1
             */
            'category_id' => ['required', 'exists:categories,id'],

            /**
             * The description of the incident.
             * 
             * @example I need help because...
             */
            'description' => ['required', 'string'],

            /**
             * The location gps coordinates of the incident.
             * 
             * @example [40.712776, -74.005974]
             */
            'location' => ['required', 'array', 'numeric'],
        ];
    }
}
