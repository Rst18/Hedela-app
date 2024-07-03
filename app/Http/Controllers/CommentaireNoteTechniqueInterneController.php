<?php

namespace App\Http\Controllers;

use App\Models\CommentaireNoteTechniqueInterne;
use App\Http\Requests\StoreCommentaireNoteTechniqueInterneRequest;
use App\Http\Requests\UpdateCommentaireNoteTechniqueInterneRequest;

class CommentaireNoteTechniqueInterneController extends Controller
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
    public function store(StoreCommentaireNoteTechniqueInterneRequest $request)
    {
        try {

            $commentaire = CommentaireNoteTechniqueInterne::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$commentaire];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentaireNoteTechniqueInterne $commentaireNoteTechniqueInterne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentaireNoteTechniqueInterne $commentaireNoteTechniqueInterne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentaireNoteTechniqueInterneRequest $request, CommentaireNoteTechniqueInterne $commentaireNoteTechniqueInterne)
    {
        try {

            $commentaireNoteTechniqueInterne->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentaireNoteTechniqueInterne $commentaireNoteTechniqueInterne)
    {
        try {

            $commentaireNoteTechniqueInterne->delete();
            
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression'];
        }
    }
}
