<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'user',
            'attributes' => $this->getAttributes(),
            'relationships' => $this->getRelationships(),
        ];
    }

    private function getAttributes(): array
    {
        return [
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
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
            'roles' =>  RoleResource::collection($this->whenLoaded('roles')),
        ];
    }
}
