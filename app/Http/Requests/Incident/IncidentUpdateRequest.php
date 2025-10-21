<?php

namespace App\Http\Requests\Incident;

use Clickbar\Magellan\Data\Geometries\Point;
use Clickbar\Magellan\Rules\GeometryGeojsonRule;
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
            // 'title' => ['string', 'max:255'],

            /**
             * The category of the incident.
             * 
             * @example 1
             */
            'category_id' => ['exists:incident_categories,id'],

            /**
             * The description of the incident.
             * 
             * @example I need help because...
             */
            'description' => ['string'],

            /**
             * The status of the incident.
             * 
             * @example reported
             */
            'status' => ['in:reported,assigned,verified,resolved,closed'],


            'location' => [new GeometryGeojsonRule([Point::class])],

            /**
             * The type of the geometry.
             * 
             * @example Point
             */
            'location.type' => ['in:Point'],

            /**
             * The coordinates of the geometry.
             * 
             * @example [-73.935242, 40.73061]
             */
            'location.coordinates' => ['array', 'size:2'],
        ];
    }

    public function geometries(): array
    {
        return ['location'];
    }
}
