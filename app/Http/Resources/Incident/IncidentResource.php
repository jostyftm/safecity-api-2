<?php

namespace App\Http\Resources\Incident;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncidentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type'          => 'incident',
            'id'            => $this->id,
            'attributes'    => $this->getAttributes(),
            'relationships' => $this->getRelationships(),
        ];
    }

    /**
     * Get the attributes for the resource.
     * 
     * @return array<string, mixed>
     */
    private function getAttributes(): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'status'        => $this->status,
            'location'      => $this->location,
            'reported_at'   => $this->reported_at,
            'assigned_at'   => $this->assigned_at,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }

    /**
     * Get the relationships for the resource.
     * 
     * @return array<string, mixed>
     */
    private function getRelationships(): array
    {
        return [
            /**
             * Incident reporter relationship
             */
            'reporter'     => new UserResource($this->whenLoaded('reporter')),

            /**
             * Incident category relationship
             */
            'category'     => new IncidentCategoryResource($this->whenLoaded('category')),
        ];
    }
}
