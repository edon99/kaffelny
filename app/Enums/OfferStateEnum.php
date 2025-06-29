<?php

namespace App\Enums;

enum OfferStateEnum :int
{
    case PENDING = 1;
    case SEEN = 2;
    case ACCEPTED = 3;
    case CANCELED = 4;
    case FINISHED = 5;

    public static function values(): array {
        return array_column(self::cases(), 'value');
    }
    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::SEEN => 'Seen',
            self::ACCEPTED => 'Accepted',
            self::CANCELED => 'Canceled',
            self::FINISHED => 'Finished',
        };
    }
}
