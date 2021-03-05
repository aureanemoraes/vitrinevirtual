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
            'id' => $this->id,
            'main_name' => $this->main_name,
            'description' => $this->description,
            'price' => $this->price,
            'payment_methods' => $this->payment_methods,
            'images' => ImageResource::collection($this->images),
            'user' => $this->user
        ];
    }
}
