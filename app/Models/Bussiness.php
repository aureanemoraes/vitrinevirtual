<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bussiness extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function address() {
        return $this->belongsToMany(Address::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function socialMedia() {
        return $this->belongsToMany(SocialMedia::class, 'social_media_bussiness');
    }
}
