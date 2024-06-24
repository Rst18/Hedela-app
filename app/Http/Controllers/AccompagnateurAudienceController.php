<?php

namespace App\Http\Controllers;

use App\Models\AccompagnateurAudience;
use App\Http\Requests\StoreAccompagnateurAudienceRequest;
use App\Http\Requests\UpdateAccompagnateurAudienceRequest;

class AccompagnateurAudienceController extends Controller
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
    public function store(StoreAccompagnateurAudienceRequest $request)
    {
        try {

            $new = AccompagnateurAudience::create($request->validated);
            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$new];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AccompagnateurAudience $accompagnateurAudience)
    {
        return $accompagnateurAudience;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccompagnateurAudience $accompagnateurAudience)
    {
        return $accompagnateurAudience;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccompagnateurAudienceRequest $request, AccompagnateurAudience $accompagnateurAudience)
    {
        try {

            $accompagnateurAudience->update($request->validated);

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccompagnateurAudience $accompagnateurAudience)
    {
        try {

            $accompagnateurAudience->delete();

            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;\
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }
}
