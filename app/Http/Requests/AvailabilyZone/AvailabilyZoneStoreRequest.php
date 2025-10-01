<?php

namespace App\Http\Requests\AvailabilyZone;

use App\Rules\Geometry\ValidatePolygon;
use Illuminate\Foundation\Http\FormRequest;

class AvailabilyZoneStoreRequest extends FormRequest
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
             * The name of the availability zone.
             * 
             * @example Downtown Zone
             */
            'name' => 'required|string|max:255',

            /**
             * The ID of the city associated with the availability zone.
             * 
             * @example 1
             */
            'city_id' => 'required|integer|exists:cities,id',

            /**
             * The geographical area covered by the availability zone.
             */
            'area' => ['required', 'array', 'min:3', new ValidatePolygon()],
            'area.*.lat' => ['required', 'numeric', 'between:-90,90'],
            'area.*.lng' => ['required', 'numeric', 'between:-180,180'],
        ];
    }
}
