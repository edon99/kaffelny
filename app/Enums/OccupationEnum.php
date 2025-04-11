<?php

namespace App\Enums;

enum OccupationEnum: string {
    case BABYSITTER = 'Baby Sitter';
    case ELDER_CARE = 'Elder Carer';
    case DOCTOR = 'Doctor';

    public static function values(): array {
        return array_column(self::cases(), 'value');
    }
}
