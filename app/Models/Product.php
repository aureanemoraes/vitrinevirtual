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

    protected $casts = [
      'payment_methods' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->belongsTo(Image::class);
    }
}
