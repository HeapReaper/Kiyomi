<?php

namespace App\Helpers;

class logs
{
    public static function laravel(): array
    {
        return array_reverse(file(storage_path('logs/laravel.log')));
    }

    public static function userError(): array
    {
        return array_reverse(file(storage_path('logs/user_error.log')));
    }

    public static function purgeLogs(): void
    {
        file_put_contents(storage_path('logs/laravel.log'), '');
        file_put_contents(storage_path('logs/user_error.log'), '');
    }
}