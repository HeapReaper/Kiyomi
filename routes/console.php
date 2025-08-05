<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// TODO: Remove, temp fix for Flight stats
Schedule::command('view:clear')->everyMinute();
Schedule::command('view:cache')->everyMinute();