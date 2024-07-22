<?php

namespace App\Console\Commands;

use App\Models\Reunion;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class ChechReunion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:chech-reunion';

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
        
        // recuperation de toutes les reunions prevu aujourdhui a cette heure et date

        $reunions = Reunion::where('status',0)
                    ->whereBetween('date_debut',[$startOfMinute, $endOfMinute])
                        ->get();

        if ($reunions != null) {

            foreach ($reunions as $key => $reunion) {

                $reunion->update(['status' => 1]);

            }
        }

        $this->info('Reunion overtes !');



        //recuperation de toutes les reunions a cloturer aujourdhui



    }
}
