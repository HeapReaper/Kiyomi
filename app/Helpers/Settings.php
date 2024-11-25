<?php

namespace App\Helpers;

use Modules\Settings\Models\Setting;

class Settings
{
    public static function get(string $name): string
    {
        return Setting::where('name', $name)->first()->value;
    }

    public static function insertOrUpdate(string $name, string $value)
    {
        $setting = Setting::where('name', $name)->first();

        if (!$setting) {
            Setting::create([
                'name' => $name,
                'value' => $value,
            ]);

            return;
        }

        $setting->value = $value;
        $setting->save();
    }
}