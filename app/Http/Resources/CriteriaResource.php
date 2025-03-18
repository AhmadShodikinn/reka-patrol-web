<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CriteriaResource extends JsonResource
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
            'criteria_type' => $this->criteria_type,
            'location_id' => $this->location_id,
            'location' => $this->whenLoaded('location'),
            'criteria_name' => $this->criteria_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
