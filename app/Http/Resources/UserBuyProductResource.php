<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserBuyProductResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'user_name' => optional($this->user)->name,
            'phone' => optional($this->user)->phone,
            'product_name' => optional($this->product)->name,
            'product_price' => (integer)optional($this->product)->price,
            'address' => 'cairo',
            'created_at' => $this->created_at,


        ];
    }
}
