<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicalRecordResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'medical_type_id' => $this->medical_type_id,
            'medicalType' =>MedicalTypeResource::make($this->whenLoaded('medicalType')),



        ];

    }

}
