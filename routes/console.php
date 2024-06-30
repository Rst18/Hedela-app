<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use App\Mail\RendezvousMailNotification;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\TaskCloseCommand;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

Schedule::call(function(){
    Mail::to('kaserekamwiraros@gmail.com')->send(New RendezvousMailNotification('Bonjour !'));
})->everyMinute();
