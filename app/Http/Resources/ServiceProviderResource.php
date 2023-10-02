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
            'image' => $this->image,
            'isActive' => $this->is_active,
            'imageCard' => $this->imageCard,
            'imageBusinessCard' => $this->imageBusinessCard,
            'IsComplateProfile'=>$this->IsComplateProfile

        ];
    }
}
