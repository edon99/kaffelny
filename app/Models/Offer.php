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
        'service' => ServiceEnum::class,
        'state' => OfferStateEnum::class,
        'created_at' => 'datetime:d-m-Y H:i:s',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

}
