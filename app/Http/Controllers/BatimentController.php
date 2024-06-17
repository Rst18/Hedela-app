<?php

namespace App\Http\Controllers;

use App\Models\Batiment;
use App\Http\Requests\StoreBatimentRequest;
use App\Http\Requests\UpdateBatimentRequest;

class BatimentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Batiment::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Batiment/Index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBatimentRequest $request)
    {
        try {
            $new = Batiment::create($request->validated());
            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$new];
        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Batiment $batiment)
    {
        return $batiment;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batiment $batiment)
    {
        return $batiment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBatimentRequest $request, Batiment $batiment)
    {
        try {

            $batiment->update($request->validated());
            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batiment $batiment)
    {
        try {
            $batiment->delete();
            return ['type'=>'success','message'=>'Suppression reussie'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }
}
