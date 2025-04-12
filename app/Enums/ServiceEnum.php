<?php

namespace App\Enums;

enum ServiceEnum: int {
    case BABYSITTING = 1;
    case ELDER_CARE = 2;
    case HEALTH_CARE = 3;

    public function label(): string
    {
        return match($this) {
            self::BABYSITTING => 'Baby Sitting',
            self::ELDER_CARE => 'Elder Care',
            self::HEALTH_CARE => 'Health Care',
        };
    }

    public static function values(): array {
        return array_column(self::cases(), 'value');
    }
}
