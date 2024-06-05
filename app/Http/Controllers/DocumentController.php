<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
    public function store(StoreDocumentRequest $request)
    {
        try {

            $document = Document::create($request->validated());

            return ['type'=>'succes','message'=>'Enregistrement reussi','new'=>$document];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Enregistrement reussi','new'=>$document];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return $document;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        return $document;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        try {

            $document->update($request->validated());

            return ['type'=>'succes','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        try {

            $document->delete();

            return ['type'=>'succes','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }
}
