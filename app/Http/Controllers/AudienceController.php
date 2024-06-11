<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Http\Requests\StoreAudienceRequest;
use App\Http\Requests\UpdateAudienceRequest;

class AudienceController extends Controller
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
    public function store(StoreAudienceRequest $request)
    {
        try {

            $audience = Audience::create($request->validated());

            //Envoie de la notification a l'user_requested

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$audience];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'Enregisrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Audience $audience)
    {
        return $audience;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Audience $audience)
    {
        return $audience;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAudienceRequest $request, Audience $audience)
    {
        try {

            $audience->update($request->validated());
            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'success','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Audience $audience)
    {
        try {
            $audience->delete();
            return ['type'=>'success','message'=>'Suppression reussie'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'success','message'=>"Echec de suppression ",'errorMessage'=>$th];
        }
    }
}
