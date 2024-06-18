<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Audience;
use Illuminate\Http\Request;
use App\Models\RendezvousAudience;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRendezvousAudienceRequest $request)
    {
        try {

           $rendezvous =  RendezvousAudience::create($request->validated());

           // changer le statut de l'audience

            Audience::find($request->audience_id)->update(['status'=>2]);

           //envoi la notification au user qui a enregistrer l'audience et au mail du demandeur

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

        return Inertia::render('Audience/ListAudienceRendezvous');
        
    }
    public function create_for_the_boss(){

        return Inertia::render('Audience/ListAudienceRendezvousBoss');
        
    }
}
