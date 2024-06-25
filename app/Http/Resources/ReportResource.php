<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'property_name' => $this->property->name,
            'property_location' => $this->property->collegeBlock->name,
            'description' => $this->description,
            'reported_on' => $this->created_at,
            'status' => $this->status,
        ];
    }
}
