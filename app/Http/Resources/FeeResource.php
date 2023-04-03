<?php

namespace App\Http\Resources;

use App\Http\Resources\ResidentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FeeResource extends JsonResource
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
            'payment_method' => $this->payment_method,
            'payment_document' => $this->payment_document ? url(env('SYNDICATE_FEES_UPLOAD_PATH') . $this->payment_document) : "-",
            'resident' => new ResidentResource($this->resident),
            'createdAt' => $this->created_at->format('Y-m-d H:i:s'),
            
        ];
        
    }
}
