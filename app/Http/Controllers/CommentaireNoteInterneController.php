<?php

namespace App\Http\Controllers;

use App\Models\CommentaireNoteInterne;
use App\Models\CommentaireNoteTechniqueInterne;
use App\Http\Requests\StoreCommentaireNoteInterneRequest;
use App\Http\Requests\UpdateCommentaireNoteInterneRequest;

class CommentaireNoteInterneController extends Controller
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
    public function store(StoreCommentaireNoteInterneRequest $request)
    {
        try {

            $commentaire = CommentaireNoteInterne::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$commentaire];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentaireNoteInterne $commentaireNoteInterne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentaireNoteInterne $commentaireNoteInterne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentaireNoteTechniqueInterneRequest $request, CommentaireNoteInterne $commentaireNoteInterne)
    {
        try {

            $commentaireNoteInterne->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentaireNoteInterne $commentaireNoteInterne)
    {
        try {

            $commentaireNoteInterne->delete();
            
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression'];
        }
    }
}
