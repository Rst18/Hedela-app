<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class CheckTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-task';

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
         //Carbon::now()->format('Y-m-d H:i:s')
         $now = Carbon::now();
         $startOfMinute = $now->copy()->startOfMinute();
         $endOfMinute = $now->copy()->endOfMinute()->addSecond(-1);

         $startTime = $now->copy()->subMinutes(15)->startOfMinute();
         $endTime = $now->copy()->startOfMinute();



         // recuperation de toutes les taches prevu aujourdhui a cette heure et date
         $tasks_to_open = Task::where('statut',0)
                     ->whereBetween('date_debut',[$startOfMinute, $endOfMinute])
                         ->get();

         if ($tasks_to_open != null) {

             foreach ($tasks_to_open as $key => $task) {

                 $task->update(['statut' => 1]);

             }
         }



         $tasks_to_close = Task::where('statut',0)
                                ->whereBetween('date_fin',[$startOfMinute, $endOfMinute])
                                    ->get();

            if ($tasks_to_close != null) {

                foreach ($tasks_to_close as $key => $task) {

                    $task->update(['statut' => 2]);

                }
            }

         $this->info('Taches overtes !');



         //recuperation de toutes les tasks a cloturer aujourdhui


    }
}
