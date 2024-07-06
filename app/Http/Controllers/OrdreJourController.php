<?php

namespace App\Http\Controllers;

use App\Models\OrdreJour;
use App\Http\Requests\StoreOrdreJourRequest;
use App\Http\Requests\UpdateOrdreJourRequest;

class OrdreJourController extends Controller
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
    public function store(StoreOrdreJourRequest $request)
    {
        try {

            $ordreJour = OrdreJour::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussie','new'=>$ordreJour];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'Enregistrement ','errorMessage'=>$th];

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OrdreJour $ordreJour)
    {
        return $ordreJour;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdreJour $ordreJour)
    {
        return $ordreJour;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrdreJourRequest $request, OrdreJour $ordreJour)
    {
        try {

            $ordreJour->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification'];

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrdreJour $ordreJour)
    {
        try {

            $ordreJour->delete();

            // supression des annexes lies a l'ordre du jour

            return ['type'=>'success','message'=>'Suppression reussue'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression'];

        }
    }
}
