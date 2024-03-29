<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'document' => $this->url ? url(env('SYNDICATE_DOCUMENTS_UPLOAD_PATH') . $this->url) : "-",
            'createdAt' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
