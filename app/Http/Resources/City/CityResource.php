<?php

namespace App\Http\Resources\City;

use App\Http\Resources\Province\ProvinceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'City',
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
            'province' => ProvinceResource::make($this->whenLoaded('province')),
        ];
    }
}
