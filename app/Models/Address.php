<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'zip_code',
        'public_place',
        'place_number',
        'neighborhood',
        'complement',
        'uf'
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function bussinesses() {
        return $this->belongsToMany(Bussiness::class);
    }
}
