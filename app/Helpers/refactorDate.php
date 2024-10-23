<?php

namespace App\Helpers;

class refactorDate
{
    public static function refactorDate(string $date): string
    {
        $date = new DateTime($date);
        return $date->format('d-m-Y');
    }
}
/**
 * Refactores date to d-m-y
 *
 * @author AutiCodes
 * @return string
 */
