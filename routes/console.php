<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('quiz:auto-notify')->everySecond();
Schedule::command('quiz:notify')->everySecond();
Schedule::command('chat:auto-notify')->everySecond();
Schedule::command('quiz:activate')->everySecond();
Schedule::command('quiz-sets:activate')->everySecond();

// Calculate daily winners every day at midnight
Schedule::command('winners:calculate')->dailyAt('00:01');
