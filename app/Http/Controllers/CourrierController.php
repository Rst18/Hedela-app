<?php

namespace App\Http\Controllers;

use App\Models\Courrier;
use App\Http\Requests\StoreCourrierRequest;
use App\Http\Requests\UpdateCourrierRequest;
use Illuminate\Support\Facades\Storage;

class CourrierController extends Controller
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
    public function store(StoreCourrierRequest $request)
    {
        try {

            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('documents/'.$request->number, $fileName); // Store the file
    

           $courrier =  Courrier::create($request->validated());

           
           // LANCER UN EVENEMENT 


           return ['type'=>'success','message'=>'Enregistrement reussie','new'=>$courrier];


        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Courrier $courrier)
    {
        return $courrier;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courrier $courrier)
    {
        return $courrier;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourrierRequest $request, Courrier $courrier)
    {
        try {

            $courrier->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courrier $courrier)
    {
        try {

            $courrier->delete();

            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Suppression reussie','errorMessage'=>$th];
        }
    }
}
