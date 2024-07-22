<?php

use App\Models\Batiment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use App\Mail\RendezvousMailNotification;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\TaskCloseCommand;

//   Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();
// Schedule::call(function () {
//     Mail::to('kaserekamwiraros@gmail.com')->send(New RendezvousMailNotification('Bonjour !'));
//     // Batiment::create([
//     //     'name'=>'R',
//     //     'niveau'=>4
//     // ]);

// })->everySecond();

// Schedule::call(function(){

//     Log::info("message");
//     Mail::to('kaserekamwiraros@gmail.com')->send(New RendezvousMailNotification('Bonjour !'));


// })->everyMinute();

// Schedule::command('app:task-close-command')->everySecond();
Schedule::command('app:chech-reunion')->everyMinute();
