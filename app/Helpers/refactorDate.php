<?php

namespace App\Helpers;

use DateTime;

class refactorDate
{
    public static function refactorDate(string $date): string
    {
        $date = new DateTime($date);

        return $date->format('d-m-Y');
    }
}
