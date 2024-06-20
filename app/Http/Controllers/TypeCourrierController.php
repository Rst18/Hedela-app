<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\TypeCourrier;
use App\Http\Requests\StoreTypeCourrierRequest;
use App\Http\Requests\UpdateTypeCourrierRequest;

class TypeCourrierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TypeCourrier::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeCourriers = TypeCourrier::all();
        return Inertia::render('TypeCourrier/Index',compact('typeCourriers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeCourrierRequest $request)
    {
        try {

            $new = TypeCourrier::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$new];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeCourrier $typeCourrier)
    {
        return $typeCourrier;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeCourrier $typeCourrier)
    {
        return $typeCourrier;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeCourrierRequest $request, TypeCourrier $typeCourrier)
    {
        try {

            $typeCourrier->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeCourrier $typeCourrier)
    {
        
        try {

            $typeCourrier->delete();
            
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec du suppression','errorMessage'=>$th];
        }
    }

    public function typecourrier_list(){
        return TypeCourrier::paginate(10);
    }
}
