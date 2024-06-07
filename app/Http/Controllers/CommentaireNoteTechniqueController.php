<?php

namespace App\Http\Controllers;

use App\Models\CommentaireNoteTechnique;
use App\Http\Requests\StoreCommentaireNoteTechniqueRequest;
use App\Http\Requests\UpdateCommentaireNoteTechniqueRequest;

class CommentaireNoteTechniqueController extends Controller
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
    public function store(StoreCommentaireNoteTechniqueRequest $request)
    {
        try {

            $commentaire = CommentaireNoteTechnique::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$commentaire];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentaireNoteTechnique $commentaireNoteTechnique)
    {
        return commentaireNoteTechnique;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentaireNoteTechnique $commentaireNoteTechnique)
    {
        return commentaireNoteTechnique;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentaireNoteTechniqueRequest $request, CommentaireNoteTechnique $commentaireNoteTechnique)
    {
        try {

            $commentaireNoteTechnique->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentaireNoteTechnique $commentaireNoteTechnique)
    {
        try {

            $commentaireNoteTechnique->delete();
            
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression'];
        }
    }
}
