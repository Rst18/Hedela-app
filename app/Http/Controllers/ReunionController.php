<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Reunion;
use App\Models\OrdreJour;
use App\Models\TypeReunion;
use Illuminate\Http\Request;
use App\Models\AnnexeOrdreJour;
use App\Events\DemandeParoleSent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReunionRequest;
use App\Http\Requests\UpdateReunionRequest;
use App\Notifications\DemandeParoleNotification;

class ReunionController extends Controller
{

    
    public function getNewID(){

       return Reunion::genereNumReunionID();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        return Reunion::with(['ordresDuJour'=>function($query){
                            $query->with('annexes');
                        }])
                        ->with('orateurs')
                        ->with(['demande_parole'=>function($q){
                            $q->where('confirmed',0);
                        }])
                        ->with(['aides_memoire' =>function ($q){
                            $q->join('users','users.id','aide_memoires.user_id');
                        }])
                        ->with('aide_memoire_reunion_role')
                        ->with('participant_reunion_role')
                        ->with('preside_reunion_role')
                        ->orderBy('created_at','DESC')
                        ->paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = TypeReunion::all();
        return Inertia::render('Reunion/CreateReunion',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReunionRequest $request)
    {
        
      
        try {
            
            DB::beginTransaction();

                // Enregistrement de la reunion
                $reunion =  Reunion::create($request->validated());

                // add orateurs 

                $reunion->orateurs()->sync($request->orateurs);

                $reunion->preside_reunion_role()->sync($request->preside);

                $reunion->participant_reunion_role()->sync($request->participants);

                $reunion->aide_memoire_reunion_role()->sync($request->aide_memoires);

                //Enregistrement des points a l'ordre du jour

                for ($i=0; $i < count($request->ordreJour) ; $i++) { 

                    $ordre = OrdreJour::create([
                        
                        'name'=>$request->ordreJour[$i]['name'],
                        'description'=>isset($request->ordreJour[$i]['description']) ? $request->ordreJour[$i]['description'] : '' ,
                        'reunion_id'=>$reunion->id
                    
                    ]);

                    if ( isset($request->ordreJour[$i]['annexes']) ) {

                        for ($a=0; $a < count($request->ordreJour[$i]['annexes']) ; $a++) { 

                            $fileName = time() . '.' . $request->ordreJour[$i]['annexes'][$a]->getClientOriginalExtension();
        
                            $filePath = $request->ordreJour[$i]['annexes'][$a]->storeAs('Documents/Reunion/'.$reunion->id.'/ordreJour', $fileName);                      
                            
                            //Enregistrement des annexes pour chaque orodres du jours
                            
                            AnnexeOrdreJour::create([

                                'name'=> $ordre->name,
                                'filePath'=>$filePath,
                                'ordre_jour_id'=>$ordre->id
                            ]);
                        }

                    }
                
                }

            DB::commit();

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$reunion];

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
             return ['type'=>'error','message'=>'Echec d\'Enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $reunion =  Reunion::where('id',str_replace('++','/',$id))->with(['ordresDuJour'=>function($query){
            $query->with('annexes');
        }])
        ->with('orateurs')
        ->with(['demande_parole'=>function($q){
            $q->where('confirmed',0);
        }])
        ->with(['aides_memoire' =>function ($q){
            $q->join('users','users.id','aide_memoires.user_id');
        }])
        ->with('aide_memoire_reunion_role')
        ->with('participant_reunion_role')
        ->with('preside_reunion_role')->first();

        if ($reunion) {
            return Inertia::render('Reunion/CurrentReunion',compact('reunion'));
          
        }  
    }

      /**
     * Display the specified resource.
     */
    public function show_admin($id)
    {
        $message = 'Cette reunion est introuvable !';

       $reunion =  Reunion::where('id',str_replace('++','/',$id))->with(['ordresDuJour'=>function($query){
            $query->with('annexes');
        }])
        ->with('orateurs')
        ->with(['demande_parole'=>function($q){
            $q->where('confirmed',0);
        }])
        ->with(['aides_memoire' =>function ($q){
            $q->join('users','users.id','aide_memoires.user_id');
        }])
        ->with('aide_memoire_reunion_role')
        ->with('participant_reunion_role')
        ->with('preside_reunion_role')->first();

        if ($reunion) {
            return Inertia::render('Reunion/CurrentReunionAdmin',compact('reunion'));
          
        } else    return Inertia::render('ErrorPage',compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reunion $reunion)
    {
        return $reunion;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReunionRequest $request, )
    {
        try {
            
            $reunion = Reunion::find($request->reunion);
            
            if ($reunion) {
                
                $reunion->update($request->validated());
                
                $reunion->orateurs()->sync(array_map('intval',$request->orateurs));
                
              //  return    $reunion->orateurs()->sync(array_map('intval',$request->orateurs));

                $reunion->preside_reunion_role()->sync($request->preside);

                $reunion->participant_reunion_role()->sync($request->participants);

                $reunion->aide_memoire_reunion_role()->sync($request->aide_memoires);

                //Enregistrement des points a l'ordre du jour

                // for ($i=0; $i < count($request->ordreJour) ; $i++) { 

                //     $ordre = OrdreJour::create([
                        
                //         'name'=>$request->ordreJour[$i]['name'],
                //         'description'=>isset($request->ordreJour[$i]['description']) ? $request->ordreJour[$i]['description'] : '' ,
                //         'reunion_id'=>$reunion->id
                    
                //     ]);

                //     if ( isset($request->ordreJour[$i]['annexes']) ) {

                //         for ($a=0; $a < count($request->ordreJour[$i]['annexes']) ; $a++) { 

                //             $fileName = time() . '.' . $request->ordreJour[$i]['annexes'][$a]->getClientOriginalExtension();
        
                //             $filePath = $request->ordreJour[$i]['annexes'][$a]->storeAs('Documents/Reunion/'.$reunion->id.'/ordreJour', $fileName);                      
                            
                //             //Enregistrement des annexes pour chaque orodres du jours
                            
                //             AnnexeOrdreJour::create([

                //                 'name'=> $ordre->name,
                //                 'filePath'=>$filePath,
                //                 'ordre_jour_id'=>$ordre->id
                //             ]);
                //         }

                //     }
                
                // }

                return ['type'=>'success','message'=>'Modification reussie'];

            }
            return ['type'=>'error','message'=>'Cette reunion est introuvable'];


        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reunion $reunion)
    {
        try {

            $reunion->delete();

            // suppression des tous les fichers relatives a la reuion

            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;

            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }

    public function addOrateurRenion(Request $request){
      
        try {

            $user = User::find($request->user);

            $reunion = Reunion::find($request->reunion);

            if ($reunion != null) {
              
                if ($user != null) {
    
                     
                     $reunion->orateurs()->attach($user->id);

                     //notification a l'orateur
    
                    return response()->json(data:[],status:200);

                }  

                return response()->json(data:['Aucun Utilisateur trouvé !'], status:404);
            }

            return response()->json(data:['Aucune reunion trouvée !'], status:404);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(data:['errorMessage'=>$th],status:500);
        }
      
    }
    public function removeUserTask(Request $request){

        try {

            $user = User::find($request->user);

            if ($user != null) {

                $user->tasks()->detach($request->task);

                return response()->json(data:[],status:200);
            }
            return response()->json(data:['Aucun group trouvé !'],status:404);

        } catch (\Throwable $th) {
            //throw $th;
        }
      
    }

    /**
     * liste des orateurs
     */

    public function list_orateur(){
        return User::paginate(500);
    }

    public function list_page(){
        return Inertia::render('Reunion/ListReunion');
    }
    public function list_page_admin(){
        return Inertia::render('Reunion/ListReunionAdmin');
    }

    /**
     * 
     * Enregistrement dela demande de parole 
     */

    public function storeDemande_parole(Request $request){

        $reunion = Reunion::find($request->reunion_id);

        if($reunion != null){

            $reunion->demande_parole()->attach(Auth::user()->id);

            broadcast(new DemandeParoleSent($reunion));
            
            return response()->json(data:[],status:200);
        }

        return response()->json(data:['Aucune reunion trouvée !'],status:404);
    }

    /**
     * 
     * Enregistrement des groups aide memoire
    */

    public function storeAide_memoire_role(Request $request){

        $reunion = Reunion::find($request->reunion_id);

        if($reunion != null){

            $reunion->aide_memoire_reunion_role()->attach($request->role);

            return response()->json(data:[],status:200);
        }

        return response()->json(data:['Aucune reunion trouvée !'],status:404);
    }



    /**
     * 
     * Enregistrement des groups participants
    */

    public function storeParticipants__reunion_role(Request $request){

        $reunion = Reunion::find($request->reunion_id);

        if($reunion != null){

            $reunion->participant_reunion_role()->attach($request->role);

            return response()->json(data:[],status:200);
        }

        return response()->json(data:['Aucune reunion trouvée !'],status:404);
    }




    /**
     * 
     * Enregistrement des groups presidents la reunion
     * 
    */

    public function storePreside_reunion_role(Request $request){

        $reunion = Reunion::find($request->reunion_id);

        if($reunion != null){

            $reunion->preside_reunion_role()->attach($request->role);

            return response()->json(data:[],status:200);
        }

        return response()->json(data:['Aucune reunion trouvée !'],status:404);
    }


    public function list_aide_memoire_user(Request $request){

        $reunion = Reunion::where('id',$request->reunion_id);

        if ($reunion != null) {

            return $reunion->with(['aides_memoire'=>function($q){
    
                $q->where('user_id',Auth::user()->id);
    
            }])->get();
        }
    }


    /**
     * 
     * Confirmation de la demande de parole en reunion
     */

    public function confirmDemande(Request $request){
        try {
            
            $user = User::find($request->user);
            
            $reunion = Reunion::find($request->reunion);
           

            if ($reunion != null) {

                if ($reunion->demande_parole()->wherePivot('user_id', $user->id)->exists()) {

                    $reunion->demande_parole()
            
                        ->updateExistingPivot($user->id, [ 'confirmed' => 1 ]);

                        $user->notify(new DemandeParoleNotification($reunion,'Information'));

                    return ['type'=>'success','message'=>'Confirmation reussie'];
                }

                return ['type','error','message'=>'Aucune demande n\'a ete retrouvee pour cet utilisateur'];

            }
            return ['type','error','message'=>'Aucune  utilisateur trouve !'];
    
           
        } catch (\Throwable $th) {
            //throw $th;
            return ['type','error','message'=>'Une erreur s\'est produite lors du traitement de la damande','errorMessage'=>$th];
        }


    }
    public function unConfirmDemande(Request $request){
       
        try {
            
            $user = User::find($request->user);
            
            $reunion = Reunion::find($request->reunion);
           

            if ($reunion != null) {

                if ($reunion->demande_parole()->wherePivot('user_id', $user->id)->exists()) {

                    $reunion->demande_parole()
            
                        ->updateExistingPivot($user->id, [ 'confirmed' => 0 ]);
            
                    return ['type'=>'success','message'=>'Confirmation reussie'];
                }

                return ['type','error','message'=>'Aucune demande n\'a ete retrouvee pour cet utilisateur'];

            }
            return ['type','error','message'=>'Aucune  utilisateur trouve !'];
    
    
           
        } catch (\Throwable $th) {
            //throw $th;
            return ['type','error','message'=>'Une erreur s\'est produite lors du traitement de la damande','errorMessage'=>$th];
        }


    }


    /**
     * CLoture de la reunion
     */

     public function clotureReunion(Request $request){
        
        try {

            $reunion = Reunion::find($request->reunion);

            if ($reunion != null) {
               
                $reunion->update(['status'=>2]);
    
                return ['type'=>'success','message'=>'La reunion a ete bien cloturee'];
            }

            return ['type'=>'error','message'=>'Aucune reunion trouvee'];


        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Une erreur s\'est produite lors de la cloture de la reunion','errorMessage'=>$th];
        }
     }
}
