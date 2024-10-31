<?php

namespace Modules\Flights\Enums;

enum ModelName: string
{
    /**
     * Convert model integer to name
     *
     * @author AutiCodes
     * @return string
     */
    public static function convertToName(int $modelId): string
    {
        switch ($modelId) {
            case 1:
                return 'Motorvliegtuig';
                break;
            case 2:
                return 'Zweefvliegtuig';
                break;
            case 3:
                return 'Helicopter';
                break;
            case 4:
                return 'Drone';
                break;
            case 5:
                return 'Motorzweefvliegtuig';
                break;
        }
    }
}
