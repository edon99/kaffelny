<?php

namespace App\Enums;

enum OccupationEnum: int {
    case BABYSITTER = 1;
    case ELDER_CARE = 2;
    case DOCTOR = 3;

    public function label(): string{
        return match($this){
            self::BABYSITTER => 'Babysitter',
            self::ELDER_CARE => 'Elder Carer',
            self::DOCTOR => 'Doctor',
        };
    }

    public static function values(): array {
        return array_column(self::cases(), 'value');
    }
}
