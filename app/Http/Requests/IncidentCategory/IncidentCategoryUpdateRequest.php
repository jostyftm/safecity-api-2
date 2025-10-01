<?php

namespace App\Http\Requests\IncidentCategory;

use Illuminate\Foundation\Http\FormRequest;

class IncidentCategoryUpdateRequest extends FormRequest
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
        $incidentCategoryId = request()->route('incident_category')->id;
        return [
            /**
             * The name of the incident category.
             * 
             * @example Traffic
             */
            'name' => ['required', 'string', 'max:255', 'unique:incident_categories,name,' . $incidentCategoryId],
        ];
    }
}
