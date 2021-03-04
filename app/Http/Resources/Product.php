<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Image as ImageResource;

class Product extends JsonResource
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
            'main_name' => $this->id,
            'description' => $this->name,
            'price' => $this->email,
            'payment_methods' => $this->social_name,
            'images' => ImageResource::collection($this->images)
        ];
    }
}
