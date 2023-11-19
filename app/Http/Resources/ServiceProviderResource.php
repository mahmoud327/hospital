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
            'cv' => $this->cv,
            'bio' => $this->bio,
            'image' => $this->image,
            'national_id' => $this->national_id,
            'isActive' => $this->is_active,
            'service'=>CategoryResource::make($this->whenLoaded('service')),
            'imageCard' => $this->imageCard,
            'imageBusinessCard' => $this->imageBusinessCard,
            'IsComplateProfile'=>$this->IsComplateProfile,
            "rate"=>$this->rate,
            'services'=>ServiceResource::collection($this->whenLoaded('services')),
            'customerReviews' => RateResource::collection($this->whenLoaded('ratingsPure')),
            'schedules' => ScheduleResource::collection($this->whenLoaded('schedules')),


        ];
    }
}
