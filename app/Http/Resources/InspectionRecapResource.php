<?php

namespace App\Http\Resources;

use App\Models\Inspection;
use App\Models\SafetyPatrol;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InspectionRecapResource extends JsonResource
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
            'number' => $this->number,
            'issued_date' => $this->issued_date,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'description' => $this->description,
            'inspections' => $this->when(
                ($request->has('inspections') && $request->get('inspections')),
                InspectionResource::collection(
                    Inspection::whereBetween('created_at', [$this->from_date, $this->to_date])->get()
                )
            ),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
