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

        $startTime = $now->copy()->subMinutes(15)->startOfMinute();
        $endTime = $now->copy()->startOfMinute();

        //recuperation de toutes les reunions qui seront ouverte dans 15 min
        $emails = Reunion::where('status', 0)
                            ->whereBetween('date_debut',[$startTime, $endTime])
                                ->with('orateurs') // Charger les orateurs associés
                                    ->get() // Récupérer les réunions
                                        ->flatMap(function ($reunion) {
                                            return $reunion->orateurs->pluck('email'); // Extraire les emails des orateurs
                                        })
                                        ->unique(); // Pour éliminer les emails en double, si nécessaire


        // Convertir la collection d'emails en tableau, si besoin
        $emailArray = $emails->toArray();

        // Afficher les emails
        return $emailArray;

//-----------------------Envoi des mails------------------------
        // $users = User::all();

        // Mail::to($users)->send(new UserEmail($user));

        // return response()->json(['success'=>'Send email successfully.']);

//------------------------ FIn Envoi mail -------------------------------------








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
