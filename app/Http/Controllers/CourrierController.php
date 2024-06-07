<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Service;
use App\Models\Courrier;
use App\Models\TypeCourrier;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCourrierRequest;
use App\Http\Requests\UpdateCourrierRequest;

class CourrierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Courrier::select('courriers.*','services.name as service_name ','type_courriers.name as type_courrier_name')
        ->with('commentaires')
        ->join('services','services.id','service_id')
        ->join('type_courriers','type_courriers.id','type_courrier_id')
        ->paginate(20);
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourrierRequest $request)
    {
        try {

            $fileName = time() . '.' . $request->letter_file->getClientOriginalExtension();
            $request->letter_file->storeAs('documents/'.$request->number, $fileName); // Store the file
    

           $courrier =  Courrier::create($request->validated());

           
           // LANCER UN EVENEMENT 


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

            $user->courriers()->attach($request->courrier);

            return ['type'=>'success','message'=>'Enregistrement reussi'];            

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
}
