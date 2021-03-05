<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'birthdate',
        'is_admin',
        'social_name',
        'rg',
        'uf_rg',
        'gender',
        'ethnicity',
        'civil_status',
        'scholarity',
        'bussiness_name',
        'bussiness_description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'default_name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'date',
        'social_media' => 'array'
    ];

    public function findForPassport($username) {
        return $this->where('cpf', $username)->first();
    }

    public function addresses() {
        return $this->belongsToMany(Address::class);
    }

    public function socialMedia() {
        return $this->belongsToMany(SocialMedia::class, 'social_media_user');
    }

    public function phones() {
        return $this->belongsToMany(Phone::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function getDefaultNameAttribute() {
        if($this->attributes['social_name'] != null) {
            return $this->attributes['social_name'];
        } else {
            return $this->attributes['name'];
        }
    }
}
