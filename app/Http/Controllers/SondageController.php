<?php

namespace App\Http\Controllers;

use App\Models\Sondage;
use App\Http\Requests\StoreSondageRequest;
use App\Http\Requests\UpdateSondageRequest;

class SondageController extends Controller
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
    public function store(StoreSondageRequest $request)
    {
        try {

            $sondage = Sondage::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$sondage];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sondage $sondage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sondage $sondage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSondageRequest $request, Sondage $sondage)
    {
        try {

            $sondage->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sondage $sondage)
    {
        try {

            $sondage->delete();

            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }
}
