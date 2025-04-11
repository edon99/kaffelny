<?php

namespace App\Enums;

enum OfferStateEnum :String
{
    case PENDING = 'pending';
    case SEEN = 'seen';
    case ACCEPTED = 'accepted';
    case CANCELED = 'canceled';

    public static function values(): array {
        return array_column(self::cases(), 'value');
    }
}
