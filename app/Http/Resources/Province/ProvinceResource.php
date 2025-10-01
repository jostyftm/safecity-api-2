<?php

namespace App\Http\Resources\Province;

use App\Http\Resources\City\CityResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'Province',
            'id' => $this->id,
            'attributes' => $this->getAttributes(),
            'relationships' => $this->getRelationships(),
        ];
    }

    /**
     * 
     */
    private function getAttributes(): array
    {
        return [
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * 
     */
    private function getRelationships(): array
    {
        return [
            'cities' => CityResource::collection($this->whenLoaded('cities')),
        ];
    }
}
