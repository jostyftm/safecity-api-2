<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'user_auth',
            'id' => (string) $this->id,
            'attributes' => $this->getAttributes()
        ];
    }

    /**
     * Get the attributes for the resource.
     */
    public function getAttributes(): array
    {
        return [
            'name'          => $this->name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
