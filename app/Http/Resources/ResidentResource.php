<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResidentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cin' => $this->cin,
            'phone' => $this->phone,
            'address' => $this->address,
            'role' => $this->role,
            'createdAt' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
