<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Bureau;
use App\Models\Batiment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBureauRequest;
use App\Http\Requests\UpdateBureauRequest;

class BureauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Bureau::select('bureaus.*','batiments.name as batiment')->join('batiments','batiment_id','bureaus.batiment_id')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $batiments = Batiment::all();

        return Inertia::render('Bureau/Index',compact('batiments'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBureauRequest $request)
    {
        try {

            $new = Bureau::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$new];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec d\'Enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bureau $bureau)
    {
        return $bureau;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bureau $bureau)
    {
        return $bureau;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBureauRequest $request, Bureau $bureau)
    {
        try {
            $bureau->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bureau $bureau)
    {
        try {
            $bureau->delete();
            return ['type'=>'success','message'=>'Suppression reussie'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }

    
    /**
     * ATTRIBUTION DES Bureaux AUX UTILISATEURS
     */

     public function addBureau(Request $request, User $user){  

        try {

            $user->bureaux()->attach($request->bureau);

            return ['type'=>'success','message'=>'Enregistrement reussi'];            

        } catch (\Throwable $th) {

            return ['type'=>'error','message'=>"Echec d'enregistrement ",'errorMessage'=>$th];
        }
        
    }
    public function removeBureau(Request $request, User $user){  

        try {

            $user->bureaux()->detach($request->role);

            return ['type'=>'success','message'=>'Enregistrement reussi'];            

        } catch (\Throwable $th) {

            return ['type'=>'error','message'=>"Echec d'enregistrement ",'errorMessage'=>$th];
        }
    }
}
