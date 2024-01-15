<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        $timeAgo = Carbon::parse($this->created_at)->diffForHumans();

        $dataArray = [
            'id'    => $this->id,
            'type'  => class_basename($this->type),
            'date'  => $timeAgo,
        ];

        // Define the keys you want to include
        $keys = ['order', 'post', 'comment', 'user', 'receive'];

        // Add non-null values to the array
        foreach ($keys as $key) {
            if (isset($this->data[$key])) {
                $dataArray[$key] = $this->data[$key];
            }
        }

        return $dataArray;
    }
}
