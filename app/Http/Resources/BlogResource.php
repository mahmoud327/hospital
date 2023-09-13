<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'views' => $this->views,
            'description' => $this->description,
            'createdAt'=>$this->createdAt,
            'image' => $this->image_path,



        ];
    }
}
