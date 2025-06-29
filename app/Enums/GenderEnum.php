<?php

namespace App\Enums;

enum GenderEnum: int {
    case MALE = 1;
    case FEMALE = 2;


    public  function label(): string{
        return match($this){
            self::MALE => 'Male',
            self::FEMALE => 'Female',
        };
    }

    public static function values(): array {
        return array_column(self::cases(), 'value');
    }
}
