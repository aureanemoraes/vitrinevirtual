<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_phone',
        'type_phone',
        'is_whatsapp'
    ];

    public function user() {
        return $this->belongsToMany(User::class);
    }

    public function bussinesses() {
        return $this->belongsToMany(Bussiness::class);
    }
}
