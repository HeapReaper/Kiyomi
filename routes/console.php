<?php

use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
   Schedule::command('generate:sitemap');
})->everyMinute();
