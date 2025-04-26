<?php

namespace Modules\Payments\Enums;

enum PaymentStatusEnum: int
{
    case PENDING = 1;
    case PAID = 2;
    case CANCELLED = 3;
    case REFUNDED = 4;
    case FAILED = 5;

    public static function getName(int $id): string
    {
        return match ($id) {
            self::PENDING->value => 'In behandeling',
            self::PAID->value => 'Betaald',
            self::CANCELLED->value => 'Geannuleerd',
            self::REFUNDED->value => 'Terugbetaald',
            self::FAILED->value => 'Gefaald',
            default => 'Onbekend',
        };
    }
}
