<?php

namespace Modules\Payments\Enums;

enum PaymentMethodEnum: int
{
    case CASH = 1;
    case BANK_TRANSFER = 2;
    case IDEAL = 3;

    public static function getName(int $id): string
    {
        return match ($id) {
            self::CASH->value => 'Contant',
            self::BANK_TRANSFER->value => 'Bank overschrijving',
            self::IDEAL->value => 'iDeal',
            default => 'Onbekend'
        };
    }
}
