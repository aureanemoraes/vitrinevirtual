<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Address as AddressResource;
use App\Http\Resources\Phone as PhoneResource;
use App\Http\Resources\SocialMedia as SocialMediaResource;


class User extends JsonResource
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
            'name' => $this->name,
            'default_name' => $this->default_name,
            'cpf' => $this->cpf,
            'birthdate' => $this->birthdate->format('d/m/Y'),
            'is_admin' => $this->is_admin,
            'rg' => $this->rg,
            'uf_rg' => $this->uf_rg,
            'gender' => $this->gender,
            'ethnicity' => $this->ethnicity,
            'civil_status' => $this->civil_status,
            'scholarity' => $this->scholarity,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'addresses' => AddressResource::collection($this->addresses),
            'phones' => PhoneResource::collection($this->phones),
            'social_media' => SocialMediaResource::collection($this->socialMedia),

            //'bussiness' => BussinessResource::collection($this->phones),
        ];
    }
}