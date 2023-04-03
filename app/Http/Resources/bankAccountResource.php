<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class bankAccountResource extends JsonResource
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
          'id'=> $this->id,  
          'name'=> $this->name,  
          'iban'=> $this->iban,  
          'rib'=> $this->rib,  
          'bic'=> $this->bic,  
          'syndicate'=> $this->syndicate->name,  
          'createdAt' => $this->created_at->format('Y-m-d H:i:s'),  
        ];
    }
}
