<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            "id" => $this->id,
            "from" => $this->from,
            "to" => $this->to,
            "day" => $this->day,
            "date" => $this->date,

        ];

    }

}
