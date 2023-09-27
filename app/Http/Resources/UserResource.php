<?php

namespace App\Http\Resources;

use App\Http\Resources\Network\PartnerResource;
use App\Http\Resources\User\NotificationSettingResource;
use App\Http\Resources\User\PersonalInformationResource;
use App\Http\Resources\User\ResidenceInformationResource;
use App\Http\Resources\User\StudyInformationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'type' => $this->type,
            'email' => $this->email,
            'phone'=>$this->phone,
            'is_active'=>$this->is_active,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            // 'serviceProvider'=>ServiceProviderResource::make($this->whenLoaded('serviceProvider')),
            'token' => $this->createToken('authToken')->accessToken,



        ];
    }
}
