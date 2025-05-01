<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FindingResource extends JsonResource
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
            'findable_id' => $this->findable_id,
            'findable_type' => $this->findable_type,
            'findings_path' => $this->finding_path,
            'findings_description' => $this->finding_description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
