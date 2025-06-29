<?php

namespace App\Models;

use App\Enums\OfferStateEnum;
use App\Enums\ServiceEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /** @use HasFactory<\Database\Factories\OfferFactory> */
    use HasFactory;

    protected $fillable = [
        'service',
        'state',
        'hours',
        'description',
        'long',
        'lat',
        'user_id',
        'provider_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'service' => ServiceEnum::class,
        'state' => OfferStateEnum::class,
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function scopePending($query)
    {
        return $query->where('state', OfferStateEnum::PENDING);
    }

}
