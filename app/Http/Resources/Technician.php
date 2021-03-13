<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Technician extends JsonResource
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
            'form_id' => $this->form_id,
            'technician_user_id' => $this->technician_user_id,
            'task' => $this->task,
            'depart' => $this->depart,
            'return' => $this->return,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
