<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Courrier;
use App\Models\NoteTechnique;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreNoteTechniqueRequest;
use App\Http\Requests\UpdateNoteTechniqueRequest;

class NoteTechniqueController extends Controller
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
    public function store(StoreNoteTechniqueRequest $request)
    {
        try {

            $note = NoteTechnique::create($request->validated());

            // modification du status du courrier
            Courrier::find($request->courrier_id)->update(['status'=>3]);


            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$note];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'Enregistrement'];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NoteTechnique $noteTechnique)
    {
        return $noteTechnique;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NoteTechnique $noteTechnique)
    {
        return $noteTechnique;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteTechniqueRequest $request, NoteTechnique $noteTechnique)
    {
        try {

            $noteTechnique->update($request->validated());
            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NoteTechnique $noteTechnique)
    {
        try {

            $noteTechnique->delete();
            
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }

    public function valider (NoteTechnique $noteTechnique){
        try {

            $noteTechnique->update(['status'=>2]);

             // modification du status du courrier
             Courrier::find($noteTechnique->courrier_id)->update(['status'=>3]);
            
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }

    public function noteTechniqueForSecretaria (){
        
        return NoteTechnique::where('status',3)->get();
    }

    public function my_technical_notes_page(){

        return Inertia::render('NoteTechnique/MesNotes');
    }
    public function my_technical_notes(){

        return NoteTechnique::where('user_id',Auth::user()->id)
                                ->with('courrier')
        ->paginate(10);
    }
}
