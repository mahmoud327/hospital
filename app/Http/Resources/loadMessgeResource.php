<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class loadMessgeResource extends JsonResource
{
    public function toArray($request)
    {
        $isCurrentUserSender = auth()->id() == $this->from_user_id;
        $otherUser = $isCurrentUserSender ? $this->toUser : $this->fromUser;
        return [
            'id' => $this->id,
            'message' => $this->message,
            'user_name' => optional($otherUser)->name,
            'user_image' => optional($otherUser)->image_path,
            'receiver_id' => $this->to_user_id,
            'sender_id' => $this->from_user_id,
            'created_at' => $this->created_at,
            'images' => $this->images,

        ];
    }
}
