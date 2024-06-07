<?php

namespace App\Http\Controllers;

use App\Models\CommentaireCourrier;
use App\Http\Requests\StoreCommentaireCourrierRequest;
use App\Http\Requests\UpdateCommentaireCourrierRequest;

class CommentaireCourrierController extends Controller
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
    public function store(StoreCommentaireCourrierRequest $request)
    {
        try {
            $commentaire = CommentaireCourrier::create($request->validated());
            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$commentaire];
        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>"Echec d'enregistrement",'errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentaireCourrier $commentaireCourrier)
    {
        return $commentaireCourrier;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentaireCourrier $commentaireCourrier)
    {
        return $commentaireCourrier;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentaireCourrierRequest $request, CommentaireCourrier $commentaireCourrier)
    {
        try {

            $commentaireCourrier->update($request->validated());
            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentaireCourrier $commentaireCourrier)
    {
        try {
            $commentaireCourrier->delete();
            return ['type'=>'success','message'=>'Suppression reussie'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }
}
