<?php

namespace Modules\Flights\Enums;

enum ModelPowerClassName
{
    /**
     * Convert power class number to word
     *
     * @author AutiCodes
     */
    public static function convertToName(int $powerClassId): string
    {
        switch ($powerClassId) {
            case 1:
                return '<300W';
                break;
            case 2:
                return '300W-1200W';
                break;
            case 3:
                return '1200W-3000W';
                break;
            case 4:
                return '0W';
                break;
        }
    }
}
