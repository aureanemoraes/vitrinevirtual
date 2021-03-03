<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Phone extends JsonResource
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
            'number_phone' => $this->number_phone,
            'type_phone' => $this->type_phone,
            'is_whatsapp' => $this->is_whatsapp,
        ];
    }
}
