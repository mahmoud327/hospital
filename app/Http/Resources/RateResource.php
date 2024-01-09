<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
class RateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "user_id" => $this->user_id,
            "username" => optional($this->user)->username,
            "profile_image" => optional($this->user)->profile_image,
            "rate_value" => $this->relation_value,
            "comment" => $this->relation_type,
            "create_at_human" =>Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
