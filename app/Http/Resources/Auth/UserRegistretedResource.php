<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRegistretedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type'  => 'user_registered_response',
            'id'    => $this->resource->id,
            'attributes' => $this->getAttributes(),
        ];
    }

    /**
     * 
     */
    private function getAttributes(): array
    {
        return [
            'name'         => $this->resource->name,
            'email'        => $this->resource->email,
            'created_at'   => $this->resource->created_at,
            'updated_at'   => $this->resource->updated_at,
        ];
    }
}
