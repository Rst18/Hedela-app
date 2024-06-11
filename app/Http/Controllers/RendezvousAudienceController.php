<?php

namespace App\Http\Controllers;

use App\Models\Audience;
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

           Audience::find($request->status)->update(['status'=>2]);

           //envoi la notification au user qui a enregistrer l'audience et au mail du demandeur

           return ['type'=>'success','message'=>"Enregistrement reussi",'new'=>$rendezvous];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>"Echec d'enregistrement"];
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
}
