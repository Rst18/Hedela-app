<?php

namespace App\Http\Controllers;

use App\Models\OrdreJour;
use App\Models\AnnexeOrdreJour;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAnnexeOrdreJourRequest;
use App\Http\Requests\UpdateAnnexeOrdreJourRequest;

class AnnexeOrdreJourController extends Controller
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
    public function store(StoreAnnexeOrdreJourRequest $request)
    {
        try {

            $annexe = AnnexeOrdreJour::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$annexe];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'Enregistrement'];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AnnexeOrdreJour $annexeOrdreJour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnnexeOrdreJour $annexeOrdreJour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnexeOrdreJourRequest $request, AnnexeOrdreJour $annexeOrdreJour)
    {
        try {

            // suppression de l'annexe

            $data = $request->validated();
            
            if ($request->filePath !='') {

                Storage::delete('public/'.$annexeOrdreJour->filePath);
               
                $fileName = time() . '.' . $request->path->getClientOriginalExtension();

                $reunion = OrdreJour::find($request->ordre_jour_id)->reunion_id;

                $filePath = $request->path->storeAs('documents/Reuinon/'.$reunion.'/Annexes/', $fileName);
    
                $data['filePath'] =  $filePath;
            }

            $annexeOrdreJour->update($request->validated());

            return ['type'=>'success','message'=>"Modification reussie"];


        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>"Echec de Modification",'errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnexeOrdreJour $annexeOrdreJour)
    {
        try {

            Storage::delete('public/'.$annexeOrdreJour->filePath);

            $annexeOrdreJour->delete();

            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
              return ['type'=>'error','message'=>'Echec de Suppression','errorMessage'=>$th];
        }
    }
}
