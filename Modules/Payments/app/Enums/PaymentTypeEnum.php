<?php

namespace Modules\Payments\Enums;

enum PaymentTypeEnum: int
{
    case MEMBERSHIP = 1;
    case DONATION = 2;
    case SUBSIDY = 3;
    case GRANT = 4;

    public static function getName(int $id): string
    {
        return match ($id) {
          self::MEMBERSHIP->value => 'Lidmaatschap',
          self::DONATION->value => 'Donatie',
          self::SUBSIDY->value => 'Subsidie',
          default => 'Onbekend',
        };
    }
}
