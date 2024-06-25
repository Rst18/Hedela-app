<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Service;
use App\Models\Courrier;
use App\Models\TypeCourrier;
use Illuminate\Http\Request;
use App\Events\DispatchEvent;
use App\Events\CreateCourrierEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\RendezvousMailNotification;
use App\Http\Requests\StoreCourrierRequest;
use App\Notifications\DispatchNotification;
use App\Notifications\RealtimeNotification;
use App\Http\Requests\UpdateCourrierRequest;

class CourrierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Courrier::select('courriers.*','services.name as service_name ','type_courriers.name as type_courrier_name')
        ->with(['commentaires'=>function($q){$q->join('users','users.id','commentaire_courriers.user_id');}])
        ->with(['users'=>function($qry){}])
        ->with(['annexes'=>function($qry){}])
        ->with(['services'=>function($qry){}])

        ->with(['noteTechniques'=>function($qry){
            $qry->with('commentaires');
            $qry->select('users.name as user_name','note_techniques.*');
            $qry->join('users','users.id','note_techniques.user_id');
        }])
        ->join('services','services.id','service_id')
        ->join('type_courriers','type_courriers.id','type_courrier_id')
        ->orderBy('created_at','DESC')
        ->paginate(20);
    }

    public function courrier_where_has_note(){
        return Courrier::select('courriers.*','services.name as service_name ','type_courriers.name as type_courrier_name')
        ->whereHas('noteTechniques')
        ->with(['commentaires'=>function($q){$q->join('users','users.id','commentaire_courriers.user_id');}])
        ->with(['users'=>function($qry){}])
        ->with(['annexes'=>function($qry){}])
        ->with(['services'=>function($qry){}])

        ->with(['noteTechniques'=>function($qry){
            $qry->with('commentaires');
            $qry->select('users.name as user_name','note_techniques.*');
            $qry->join('users','users.id','note_techniques.user_id');
        }])
        ->join('services','services.id','service_id')
        ->join('type_courriers','type_courriers.id','type_courrier_id')
        ->orderBy('created_at','DESC')
        ->paginate(10);
    }

    public function list_courrier_protocol(){
        $services = Service::with('documents')->get();
        $typeCourriers = TypeCourrier::all();

        return Inertia::render('Courrier/ListCourrierProtocole',compact('services','typeCourriers'));
    }

    public function dispatch(){

        return Inertia::render('Courrier/Dispatch');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::with('documents')->get();
        $typeCourriers = TypeCourrier::all();

        return Inertia::render('Courrier/Index',compact('services','typeCourriers'));
    }
    public function new_number(){
        
        return  Courrier::genereNumCourrier();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourrierRequest $request)
    {
       try {

            $fileName = time() . '.' . $request->letter_file->getClientOriginalExtension();
            $filePath = $request->letter_file->storeAs('documents/'.$request->number, $fileName); // Store the file
            
            $data = $request->validated();

            $data['letter_file'] = $filePath;

           $courrier =  Courrier::create($data);

          // $courrier->services()->attach($request->service_id);
          
           // LANCER UN EVENEMENT 
          // broadcast (new CreateCourrierEvent('One courrier added from '.$request->sender));

          

           return ['type'=>'success','message'=>'Enregistrement reussie','new'=>$courrier];


        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Courrier $courrier)
    {
        return $courrier;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courrier $courrier)
    {
        return $courrier;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourrierRequest $request, Courrier $courrier)
    {
        try {

            $courrier->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courrier $courrier)
    {
        try {

            $courrier->delete();

            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Suppression reussie','errorMessage'=>$th];
        }
    }


    
    /**
     * ATTRIBUTION DES COURRIERS AUX UTILISATEURS
     */

     public function addCourrier(Request $request, User $user){  

        try {

            $courrier =  Courrier::find($request->courrier);

            if($courrier != null){

                $user->courriers()->attach($request->courrier);

                if ($courrier->status < 2) {
                
                    $courrier->update(['status' => 2]);
                }
    
                $user->notify(new DispatchNotification($courrier->number,Auth::user()->name,'Information',"venant de ( $courrier->sender ) avec comme objet ($courrier->object). Veillez consulter la liste de vos courriers."));


                return ['type'=>'success','message'=>'Enregistrement reussi'];  


            }
            return ['type'=>'error','message'=>'Ce courrier n\'existe pas'];  


                      

        } catch (\Throwable $th) {

            return ['type'=>'error','message'=>"Echec d'enregistrement ",'errorMessage'=>$th];
        }
        
    }
    public function removeCourrier(Request $request, User $user){  

        try {

            $user->courriers()->detach($request->courrier);

            return ['type'=>'success','message'=>'Enregistrement reussi'];            

        } catch (\Throwable $th) {

            return ['type'=>'error','message'=>"Echec d'enregistrement ",'errorMessage'=>$th];
        }
    }
    public function mes_courrier (){
        
        return User::where('id',Auth::user()->id)->with(['courriers'=>function($q){
            $q->with('annexes')
            ->with(['commentaires'=>function($q){$q->join('users','users.id','commentaire_courriers.user_id');}])
            ->with(['users'=>function($qry){}])
            ->with(['annexes'=>function($qry){}])
            ->with(['noteTechniques'=>function($qry){
                $qry->with('commentaires');
                $qry->select('users.name as user_name','note_techniques.*');
                $qry->join('users','users.id','note_techniques.user_id');
            }])
            
        ->join('services','services.id','service_id')
        ->join('type_courriers','type_courriers.id','type_courrier_id');
        
         $q->select('courriers.*','services.name as service_name ','type_courriers.name as type_courrier_name');
        }])->first();
    }
    public function mes_courrier_page(){
        return Inertia::render('Courrier/MesCourriers');
    }
    public function downloadFile($id){

        try {
            // telechargement de la ressourece
            return Storage::download(str_replace('++','/',$id));
        } catch (\Throwable $th) {
            //throw $th; 
            return "Une erreur est survennue lors du téléchargement, veillez réessayer plus tard";
        }
    }

    public function clotureCourrier(Courrier $courrier){

        try {

            $courrier->update(['status'=>4]);

            //notification 

            //envoie email de notification

            //Envoie de la reponse avec le fichier de la lettre en annexe

            return ['type'=>'success','message'=>"Enregistrement reussi"];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>"Echec d'enregistrement",'errorMessage'=>$th];
        }
    }

    public function statistique_courrier (){

        // total courrier 
        $total_Courrier = Courrier::count();

        //total courrier dispatch 

        $total_dispatch = Courrier::where('status',2)->count();

        //courrier non dispatch

        $total_non_dispatch = Courrier::where('status',1)->count();

        //courrier en cours de traitement

        $total_en_cours_traitement = Courrier::where('status',3)->count();

        // courrier cloture

        $total_cloture = Courrier::where('status',4)->count();

        return [

            'total_courriers'=>$total_Courrier,
            'total_dispatch'=>$total_dispatch,
            'total_non_dispatch'=>$total_non_dispatch,
            'total_cloture'=>$total_cloture,
            'total_en_cours_traitement'=>$total_en_cours_traitement,
        ];

    }

    public function courrier_where_has_note_page(){
        return Inertia::render('Courrier/ValidationNoteTechnique');
    }

    public function sendMail(){
      
        Mail::to('kaserekamwiraros@gmail.com')->send(New RendezvousMailNotification('Bonjour !'));
        //  Mail::to('kaserekamwiraros@gmail.com')->send(New RendezvousMailNotification('Bonjour !'));
    
       
       //return Auth::user()->notify(new DispatchNotification());
    }

    public function list_courrier_to_dispatch(){

        return Courrier::select('courriers.*','services.name as service_name ','type_courriers.name as type_courrier_name')
        ->with(['commentaires'=>function($q){$q->join('users','users.id','commentaire_courriers.user_id');}])
        ->with(['users'=>function($qry){}])
        ->with(['annexes'=>function($qry){}])
        ->with(['services'=>function($qry){}])

        ->with(['noteTechniques'=>function($qry){
            $qry->with('commentaires');
            $qry->select('users.name','note_techniques.*');
            $qry->join('users','users.id','note_techniques.user_id');
        }])
        ->join('services','services.id','service_id')
        ->join('type_courriers','type_courriers.id','type_courrier_id')
        ->where('status',1)
        ->orderBy('created_at','DESC')
        ->paginate(20);
    }

}
