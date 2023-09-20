<?php

namespace App\Http\Resources;

use App\Http\Resources\Network\PartnerResource;
use App\Http\Resources\User\NotificationSettingResource;
use App\Http\Resources\User\PersonalInformationResource;
use App\Http\Resources\User\ResidenceInformationResource;
use App\Http\Resources\User\StudyInformationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceProviderResource extends JsonResource
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
            'num_experience' => $this->num_experience,
            'is_staff' => $this->is_staff,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'service' => CategoryResource::make($this->whenLoaded('service')),
            'service_id' => $this->service_id,
            'DOB' => $this->DOB,
            'startDate' => $this->startDate,



        ];
    }
}
