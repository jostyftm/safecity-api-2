<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'role',
            'attributes' => $this->getAttributes(),
            'relationships' => $this->getRelationships(),
        ];
    }

    /**
     * Get the resource's attributes.
     *
     * @return array<string, mixed>
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
     * Get the resource's relationships.
     * 
     * @return array<string, mixed>
     */
    private function getRelationships(): array
    {
        return [];
    }
}
