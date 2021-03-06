<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media';

    protected $fillable = [
        'sm_name',
        'sm_url'
    ];

    protected $casts = [
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'social_media_user');
    }

    public function bussinesses() {
        return $this->belongsToMany(Bussiness::class, 'social_media_bussiness');
    }
}
