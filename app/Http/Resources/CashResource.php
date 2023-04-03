<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashResource extends JsonResource
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
            'code_operation' => $this->code_operation,
            'date_operation' => $this->date_operation,
            'amount' => $this->amount,
            'description' => $this->description,
            'syndicate' => $this->syndicate->name,
            'createdAt' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
