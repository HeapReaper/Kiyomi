<?php

namespace Modules\Payments\Enums;

enum PaymentPeriodEnum: int
{
    case DAY = 1;
    case WEEK = 2;
    case MONTH = 3;
    case YEAR = 4;
    case ONCE = 5;

    public static function getName(int $id): string
    {
        return match ($id) {
            self::DAY->value => 'Dag',
            self::WEEK->value => 'Week',
            self::MONTH->value => 'Maand',
            self::YEAR->value => 'Jaar',
            self::ONCE->value => 'Eenmalig',
            default => 'Onbekend',
        };
    }
}
