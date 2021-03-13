<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Form extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'item_id' => $this->item_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'type' => $this->type,
            'fee' => $this->fee,
            'fee_desc' => $this->fee_desc,
            'vehicle' => $this->vehicle,
            'estimated_date' => $this->estimated_date,
            'departure_date' => $this->departure_date,
            'return_date' => $this->return_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
