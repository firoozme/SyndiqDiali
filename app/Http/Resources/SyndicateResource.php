<?php

namespace App\Http\Resources;

use App\Http\Resources\FeeResource;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\ResidentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SyndicateResource extends JsonResource
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
            'name' => $this->name,
            'arabic name' => $this->syndicate_name_arabic,
            'creation date' => $this->syndicate_creation_date,
            'starting date' => $this->syndicate_starting_date,
            'residents' => ResidentResource::collection($this->residents),
            'fees' => FeeResource::collection($this->fees),
            'documents' => DocumentResource::collection($this->documents),
        ];
    }
}
