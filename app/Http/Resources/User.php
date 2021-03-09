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
            'email' => $this->email,
            'social_name' => $this->social_name,
            'default_name' => $this->default_name,
            'cpf' => $this->cpf,
            'birthdate' => $this->birthdate->format('Y-m-d'),
            'is_admin' => $this->is_admin,
            'rg' => $this->rg,
            'uf_rg' => $this->uf_rg,
            'gender' => $this->gender,
            'ethnicity' => $this->ethnicity,
            'civil_status' => $this->civil_status,
            'scholarity' => $this->scholarity,
            'bussiness_name' => $this->bussiness_name,
            'bussiness_description' => $this->bussiness_description,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'addresses' => AddressResource::collection($this->addresses),
            'phones' => PhoneResource::collection($this->phones),
            'social_media' => SocialMediaResource::collection($this->socialMedia),
            'products_count' => $this->products_count

            //'bussiness' => BussinessResource::collection($this->phones),
        ];
    }
}
