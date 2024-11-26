<?php

namespace App\Helpers;

use Modules\Settings\Models\Setting;

class Settings
{
    public static function get(string $name): string
    {
        if (!Setting::where('name', $name)->exists()) {
            return '';
        }

        return Setting::where('name', $name)->first()->value;
    }

    public static function insertOrUpdate(string $name, string $value)
    {
        if (!Setting::where('name', $name)->exists()) {
            Setting::create([
                'name' => $name,
                'value' => $value,
            ]);

            return;
        }

        Setting::where('name', $name)->update([
            'value' => $value,
        ]);
    }
}