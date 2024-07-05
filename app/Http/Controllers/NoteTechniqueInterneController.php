<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\NoteTechniqueInterne;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreNoteTechniqueInterneRequest;
use App\Http\Requests\UpdateNoteTechniqueInterneRequest;

class NoteTechniqueInterneController extends Controller
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
        return Inertia::render('NoteTechniqueInterne/Index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteTechniqueInterneRequest $request)
    {
        try {

            $note = NoteTechniqueInterne::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$note];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'Enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NoteTechniqueInterne $noteTechniqueInterne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NoteTechniqueInterne $noteTechniqueInterne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteTechniqueInterneRequest $request, NoteTechniqueInterne $noteTechniqueInterne)
    {
        try {

            $noteTechniqueInterne->update($request->validated());
            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NoteTechniqueInterne $noteTechniqueInterne)
    {
        try {

            $noteTechniqueInterne->delete();
            
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }

    public function valider (NoteTechniqueInterne $noteTechniqueInterne){
        try {

            $noteTechniqueInterne->update(['status'=>2]);

             
            
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }
    
    public function inValider (NoteTechniqueInterne $noteTechniqueInterne){
        try {

            $noteTechniqueInterne->update(['status'=>1]);

           
            
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }


    public function Imprimable (NoteTechniqueInterne $noteTechniqueInterne){
        try {

            if ($noteTechniqueInterne->visible === 0) {

                $noteTechniqueInterne->update(['visible'=>1]);
                
            }else $noteTechniqueInterne->update(['visible'=>0]);
   
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }
    public function imprimmer (NoteTechniqueInterne $noteTechniqueInterne){
        try {

            $noteTechniqueInterne->update(['status'=>3]);

            
            
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }

    public function noteTechniqueForSecretaria (){
        
        return NoteTechniqueInterne::where('status',2)->with('courrier')->paginate(10);
    }
    public function noteTechniqueForSecretaria_page(){
        
        return Inertia::render('Secretariat/Index');
    }

    public function my_technical_notes_page(){

        return Inertia::render('NoteTechniqueInterne/MesNotes');
    }
    public function my_technical_notes(){

        return NoteTechniqueInterne::where('user_id',Auth::user()->id)
                                ->with('annexes')
                                ->with('commentaires')
                                
        ->paginate(10);
    }
}
