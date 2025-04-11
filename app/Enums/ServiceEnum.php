<?php

namespace App\Enums;

enum ServiceEnum: string {
    case BABYSITTING = 'Baby Sitting';
    case ELDER_CARE = 'Elder Care';
    case HEALTH_CARE = 'Health Care';

    public static function values(): array {
        return array_column(self::cases(), 'value');
    }
}
