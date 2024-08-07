<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\RendezvousMailNotification;

class TaskCloseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task-close-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // recuperatios de toute les reunion qui sont programmer pour cette date et heure

       // $reunion = Reunion::where()->get();


        Mail::to('kaserekamwiraros@gmail.com')->send(New RendezvousMailNotification('Bonjour !'));
        $this->info('Mail sent successfully!');
    }
}
