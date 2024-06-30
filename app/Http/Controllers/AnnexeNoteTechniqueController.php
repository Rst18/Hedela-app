<?php

namespace App\Http\Controllers;

use App\Models\NoteTechnique;
use App\Models\AnnexeNoteTechnique;
use App\Http\Requests\StoreAnnexeNoteTechniqueRequest;
use App\Http\Requests\UpdateAnnexeNoteTechniqueRequest;

class AnnexeNoteTechniqueController extends Controller
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
    public function store(StoreAnnexeNoteTechniqueRequest $request)
    {
        try {

            $data = $request->validated();


            $fileName = time() . '.' . $request->path->getClientOriginalExtension();
            $id = NoteTechnique::find($request->note_technique_id)->id;
            $filePath = $request->path->storeAs('documents/NoteTechniques'.$id.'/Annexes/', $fileName);

            $data['path'] =  $filePath;
            AnnexeNoteTechnique::create($data);

            return ['type'=>'success','message'=>'Enrgistrement reussi'];
            
        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec d\'Enrgistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AnnexeNoteTechnique $annexeNoteTechnique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnnexeNoteTechnique $annexeNoteTechnique)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnexeNoteTechniqueRequest $request, AnnexeNoteTechnique $annexeNoteTechnique)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnexeNoteTechnique $annexeNoteTechnique)
    {
        //
    }
}
