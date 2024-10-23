<?php

namespace App\Helpers;

/**
 * Refactores date to d-m-y
 *
 * @author AutiCodes
 * @return string
 */
function refactorDate(string $date): string
{
    $date = new DateTime($date);
    return $date->format('d-m-Y');
}