<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_name',
        'description',
        'price',
        'payment_methods'
    ];

    public function bussiness() {
        return $this->belongsTo(Bussiness::class);
    }
}
