<?php

namespace App\Http\Controllers;

use App\Models\NoteTechniqueInterne;
use Illuminate\Support\Facades\Storage;
use App\Models\AnnexeNoteTechniqueInterne;
use App\Http\Requests\StoreAnnexeNoteTechniqueInterneRequest;
use App\Http\Requests\UpdateAnnexeNoteTechniqueInterneRequest;

class AnnexeNoteTechniqueInterneController extends Controller
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
    public function store(StoreAnnexeNoteTechniqueInterneRequest $request)
    {
        try {

            $data = $request->validated();


            $fileName = time() . '.' . $request->path->getClientOriginalExtension();
            $id = NoteTechniqueInterne::find($request->note_technique_internr_id)->id;
            $filePath = $request->path->storeAs('documents/NoteTechniqueInternes'.$id.'/Annexes/', $fileName);

            $data['path'] =  $filePath;

            AnnexeNoteTechniqueInterne::create($data);

            return ['type'=>'success','message'=>'Enrgistrement reussi'];
            
        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec d\'Enrgistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AnnexeNoteTechniqueInterne $annexeNoteTechniqueInterne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnnexeNoteTechniqueInterne $annexeNoteTechniqueInterne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnexeNoteTechniqueInterneRequest $request, AnnexeNoteTechniqueInterne $annexeNoteTechniqueInterne)
    {
        try {

            if ($request->path != '') {

                Storage::delete('public/'.$annexeNoteTechniqueInterne->path);
               
                $fileName = time() . '.' . $request->path->getClientOriginalExtension();
                $id = NoteTechniqueInterne::find($request->note_technique_internr_id)->id;
                $filePath = $request->path->storeAs('documents/NoteTechniqueInternes'.$id.'/Annexes/', $fileName);
                $data['path'] = $filePath;
            }


            $annexeNoteTechniqueInterne->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de Modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnexeNoteTechniqueInterne $annexeNoteTechniqueInterne)
    {
        try {

            Storage::delete('public/'.$annexeNoteTechniqueInterne->path);

            $annexeNoteTechniqueInterne->delete();

            return ['type'=>'success','message'=>'Suppression reussie'];
                           
        } catch (\Throwable $th) {
            //throw $th;\\\
            return ['type'=>'error','message'=>'Echec de suppression ','errorMessage'=>$th];
        }
    }
}
