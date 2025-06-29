<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Provider extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'birthdate',
        'gender',
        'occupation',
        'email',
        'phone',
        'pay_per_hour',
        'profile_image',
        'id_card',
        'verification_certificate',
        'email_verified_at',
        'password',
        'long',
        'lat',
    ];

    protected $casts = [
        'gender' => \App\Enums\GenderEnum::class,
        'occupation' => \App\Enums\OccupationEnum::class,
        'email_verified_at' => 'datetime:d-m-Y H:i:s',
        'birthdate' => 'datetime:d-m-Y',
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
