<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'image' => $this->image_path,
            'desc' => $this->desc,
            'created_at' =>$this->created_at,
            'category_id' =>$this->category_id,
            'category' =>SubCategoryResource::make($this->whenLoaded('category')),


        ];

    }

}
