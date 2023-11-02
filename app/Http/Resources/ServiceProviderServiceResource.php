<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceProviderServiceResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'service_id' => $this->service_id,
            'price' => $this->price,
            'service'=>CategoryResource::make($this->whenLoaded('service'))
        ];

    }

}
