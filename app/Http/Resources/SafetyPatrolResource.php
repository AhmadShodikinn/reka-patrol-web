<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SafetyPatrolResource extends JsonResource
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
            'worker_id' => $this->worker_id,
            'worker' => UserResource::make($this->whenLoaded('worker')),
            'pic_id' => $this->pic_id,
            'pic' => UserResource::make($this->whenLoaded('pic')),
            'findings_path' => $this->findings_path,
            'findings_description' => $this->findings_description,
            'location' => $this->location,
            'category' => $this->category,
            'risk' => $this->risk,
            'checkup_date' => $this->checkup_date,
            'action_path' => $this->action_path,
            'action_description' => $this->action_description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
