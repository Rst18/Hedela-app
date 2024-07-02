<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\CourrierSortant;
use App\Http\Requests\StoreCourrierSortantRequest;
use App\Http\Requests\UpdateCourrierSortantRequest;

class CourrierSortantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CourrierSortant::orderBy('created_at','DESC')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('CourrierSortant/CourrierSortant');
    }
    public function list_page()
    {

        return Inertia::render('CourrierSortant/ListCourrierSortant');
    }

    public function newNumber(){
        return CourrierSortant::genereNumCourrier();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourrierSortantRequest $request)
    {
        try {

            $fileName = time() . '.' . $request->letter_file->getClientOriginalExtension();
            $filePath = $request->letter_file->storeAs('documents/CourrierSortant/'.$request->number, $fileName); // Store the file
            
            $data = $request->validated();

            $data['letter_file'] = $filePath;

           $courrier =  CourrierSortant::create($data);

          // $courrier->services()->attach($request->service_id);
           // LANCER UN EVENEMENT 
          // broadcast (new CreateCourrierEvent('One courrier added from '.$request->sender));

          

           return ['type'=>'success','message'=>'Enregistrement reussie','new'=>$courrier];


        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CourrierSortant $courrierSortant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourrierSortant $courrierSortant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourrierSortantRequest $request, CourrierSortant $courrierSortant)
    {
        try {

            $fileName = time() . '.' . $request->letter_file->getClientOriginalExtension();
            $filePath = $request->letter_file->storeAs('documents/CourrierSortant/'.$courrierSortant->number, $fileName); // Store the file

            $fileName_accuse_reception_file = time() . '.' . $request->letter_file->getClientOriginalExtension();
            $filePath_accuse_reception_file = $request->letter_file->storeAs('documents/CourrierSortant/'.$courrierSortant->number, $fileName_accuse_reception_file); // Store the file
            
            $data = $request->validated();

            $data['letter_file'] = $filePath;
            $data['accuse_reception_file'] = $filePath_accuse_reception_file;

             $courrierSortant->update($data);

          // $courrier->services()->attach($request->service_id);
           // LANCER UN EVENEMENT 
          // broadcast (new CreateCourrierEvent('One courrier added from '.$request->sender));

          

           return ['type'=>'success','message'=>'Enregistrement reussie'];


        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourrierSortant $courrierSortant)
    {
        try {
            $courrierSortant->delete();
            return ['type'=>'success','message'=>'Suppression reussie'];
            //code...
        } catch (\Throwable $th) {
            //throw $th;
          return ['type'=>'success','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }
}
