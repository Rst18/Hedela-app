<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Reunion;
use App\Http\Requests\StoreReunionRequest;
use App\Http\Requests\UpdateReunionRequest;

class ReunionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Reunion::with(['ordresDuJour'=>function($query){
                                $query->with('annexes');
                        }])
                        ->with('orateurs')
                            ->orderBy('created_at','DESC')
                            ->paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Reunion/CreateReunion');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReunionRequest $request)
    {
        try {
            // Enregistrement de la reunion
            $reunion =  Reunion::create($request->validated);

            //Enregistrement des points a l'ordre du jour

            for ($i=0; $i < count($ordre_jour) ; $i++) { 


                //Enregistrement des annexes pour chaque orodres du jours


                
            }

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$reunion];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'Enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reunion $reunion)
    {
        return $reunion;
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
    public function update(UpdateReunionRequest $request, Reunion $reunion)
    {
        try {

            $reunion->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

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
}
