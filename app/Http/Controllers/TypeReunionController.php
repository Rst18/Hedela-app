<?php

namespace App\Http\Controllers;

use App\Models\TypeReunion;
use App\Http\Requests\StoreTypeReunionRequest;
use App\Http\Requests\UpdateTypeReunionRequest;

class TypeReunionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TypeReunion::with('reunions')->get();
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
    public function store(StoreTypeReunionRequest $request)
    {
        try {

            $new = TypeRenion::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$new];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeReunion $typeReunion)
    {
        return $typeReunion;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeReunion $typeReunion)
    {
        return $typeReunion;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeReunionRequest $request, TypeReunion $typeReunion)
    {
        try {

            $typeReunion->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeReunion $typeReunion)
    {
        try {

            $typeReunion->delete();
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }
}
