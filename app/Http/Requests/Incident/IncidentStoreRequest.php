<?php

namespace App\Http\Requests\Incident;

use Clickbar\Magellan\Data\Geometries\Point;
use Clickbar\Magellan\Rules\GeometryGeojsonRule;
use Illuminate\Foundation\Http\FormRequest;

class IncidentStoreRequest extends FormRequest
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
            // 'title' => ['required', 'string', 'max:255'],

            /**
             * The category of the incident.
             * 
             * @example 1
             */
            'category_id' => ['required', 'exists:incident_categories,id'],

            /**
             * The description of the incident.
             * 
             * @example I need help because...
             */
            'description' => ['required', 'string'],


            'location' => ['required', new GeometryGeojsonRule([Point::class])],

            /**
             * The type of the geometry.
             * 
             * @example Point
             */
            'location.type' => ['required', 'in:Point'],

            /**
             * The coordinates of the geometry.
             * 
             * @example [-73.935242, 40.73061]
             */
            'location.coordinates' => ['required', 'array', 'size:2'],
        ];
    }

    public function geometries(): array
    {
        return ['location'];
    }
}
