<?php

namespace App\Http\Controllers;

use Rendezvous;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Audience;
use Illuminate\Http\Request;
use App\Models\RendezvousAudience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\TaskNotification;
use App\Mail\RendezvousMailNotification;
use App\Notifications\RendezvousNotification;
use App\Http\Requests\StoreRendezvousAudienceRequest;
use App\Http\Requests\UpdateRendezvousAudienceRequest;

class RendezvousAudienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Audience/ListAudienceRendezvous');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRendezvousAudienceRequest $request)
    {
        try {

           $rendezvous =  RendezvousAudience::create($request->validated());

           // changer le statut de l'audience

            $audience = Audience::find($request->audience_id);

            $audience->update(['status'=>2]);



           //envoi la notification au user qui a enregistrer l'audience et au mail du demandeur

           //notification du mail demandant le rendez vous
             
           Mail::to($audience->email)->send(New RendezvousMailNotification('Bonjour !, votre rendez vous a été fixer comme suit : Date : '.$request->date_heure .'  Lieu :'.$request->lieu));

           return ['type'=>'success','message'=>"Enregistrement reussi",'new'=>$rendezvous];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>"Echec d'enregistrement","errorMessage"=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RendezvousAudience $rendezvousAudience)
    {
        return $rendezvousAudience;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RendezvousAudience $rendezvousAudience)
    {
        return $rendezvousAudience;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRendezvousAudienceRequest $request, RendezvousAudience $rendezvousAudience)
    {
        try {

              $rendezvousAudience->update($request->validated());
 
            return ['type'=>'success','message'=>"Modification reussie"];
 
         } catch (\Throwable $th) {
             //throw $th;
             return ['type'=>'error','message'=>"Echec de modification"];
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RendezvousAudience $rendezvousAudience)
    {
        try {

            $rendezvousAudience->delete();
 
            return ['type'=>'success','message'=>"Suppression reussie"];
 
         } catch (\Throwable $th) {
             //throw $th;
             return ['type'=>'error','message'=>"Echec de suppression"];
         }
    }

    
    /**
     * ATTRIBUTION DES Renezvous AUX UTILISATEURS
     */

    public function addRendezvous(Request $request, User $user){  
    
        try {


            $user->rendezvouss()->attach($request->rendezvous);

            $rendezvous = RendezvousAudience::find($request->rendezvous);

            //notification 

            $user->notify(new RendezvousNotification("Vous avez été ajouter comme couverture à un rendez-vous.",'Information'));

            //creer une tache couverture

            $task = Task::create([

                'nom'=>'Couverture reunion ',
                'description'=>'Couverture reunion : Vous avez été ajouter comme couverture à un rendez-vous ',
                'statut'=>1,
                'priorite'=>2,
                'date_debut'=>$rendezvous->date_heure,
                'date_fin'=>$rendezvous->date_heure,
                'date_fermeture'=>Carbon::now()->addDays(2),
                'user_id'=>Auth::user()->id,
            ]);

            if ($task != null) {

                if (!$task->users()->wherePivot('user_id', $user->id)->exists()) {

                    $user->tasks()->attach($task->id);
                    $task->keepInformed()->attach(Auth::user()->id);
                }

                $user->notify(new TaskNotification("Vous avez été affecter à une tache de couverture à un rendez-vous.",'Information'));

            }

            return ['type'=>'success','message'=>'Enregistrement reussi'];            

        } catch (\Throwable $th) {

            return ['type'=>'error','message'=>"Echec d'enregistrement ",'errorMessage'=>$th];
        }
        
    }
    public function removeRendezvous(Request $request, User $user){  

        try {

            $user->rendezvous()->detach($request->rendezvous);

            //envoi de la notifiation a l'utilisateur

            return ['type'=>'success','message'=>'Enregistrement reussi'];            

        } catch (\Throwable $th) {

            return ['type'=>'error','message'=>"Echec d'enregistrement ",'errorMessage'=>$th];
        }
    }

    public function mes_rendezvous(){

        return Audience::select('audiences.*','users.name as autorite')->whereHas('rendezvous')
        ->with('accompagnateurs')
        ->with(['rendezvous'=>function($query){
            $query ->whereDate('created_at',now());
        }])
        ->join('users','audiences.user_requested','users.id')
        ->where('user_requested',Auth::user()->id)
        ->paginate(10);        
    }
    public function rendezvous_protocole(){


        return Audience::select('audiences.*','users.name as autorite')
        ->whereHas('rendezvous')
        ->with('accompagnateurs')
        ->with(['rendezvous'=>function($query){
            $query->whereDate('date_heure',now());
        }]
        )
        ->join('users','audiences.user_requested','users.id')
        ->paginate(10);        
    }
    public function mes_rendezvous_page_protocole(){

      return  Inertia::render('Audience/ListRendezvousProtocole');     
    }
    public function create_for_the_boss(){

        return Inertia::render('Audience/ListAudienceRendezvousBoss');
        
    }
}
