<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InspectionResource extends JsonResource
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
            'criteria_id' => $this->criteria_id,
            'criteria' => CriteriaResource::make($this->whenLoaded('criteria')),
            'findings' => FindingResource::collection($this->whenLoaded('findings')),
            'findings_description' => $this->findings_description,
            'inspection_location' => $this->inspection_location,
            'is_valid_entry' => $this->is_valid_entry,
            'has_memo' => $this->hasMemo(),
            'memo' => $this->when($this->hasMemo(), fn () => DocumentResource::make($this->whenLoaded('memo'))),
            'value' => $this->value,
            'suitability' => $this->suitability,
            'checkup_date' => $this->checkup_date,
            'action_path' => $this->action_path,
            'action_description' => $this->action_description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
