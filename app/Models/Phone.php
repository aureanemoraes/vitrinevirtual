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

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function getIsWhatsappAttribute() {
        if($this->attributes['is_whatsapp'] == 1) {
            return 'Sim';
        } else {
            return 'Não';
        }
    }
}
