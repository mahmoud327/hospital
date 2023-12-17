<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'service_provider_id' => $this->service_provider_id,
            'service_id' => $this->service_id,
            'service_id' => ServiceResource::collection($this->services??[]),
            'serviceProvider' => ServiceProviderResource::make($this->whenLoaded('serviceProvider')),
            'user' => UserDetailsResource::make($this->whenLoaded('user')),
            'status' => $this->status,
            'note' => $this->note,
            'appointment' => $this->appointment,
            "price_negotiation" => $this->price_negotiation,
            "total" => $this->total,




        ];
    }
}
