<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Courrier;
use App\Models\NoteTechnique;
use App\Models\CourrierSortant;
use Illuminate\Support\Facades\Storage;
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
            
            $data = $request->validated();
            $fileName = time() . '.' . $request->letter_file->getClientOriginalExtension();
            $filePath = $request->letter_file->storeAs('documents/CourrierSortant/'.$request->number, $fileName); // Store the file
            

            $data['letter_file'] = $filePath;

           $courrier =  CourrierSortant::create($data);

           if ($request->note_id !='') {

                NoteTechnique::find($request->note_id)->update(['status'=>4]);
           }
           
           if ($request->courrier_id !='') {

                Courrier::find($request->courrier_id)->update(['status'=>4]);
           }

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
            
            $data = $request->validated();

            if ($request->letter_file != '') {

                Storage::delete('public/'.$courrierSortant->letter_file);
               
                $fileName = time() . '.' . $request->letter_file->getClientOriginalExtension();
                $filePath = $request->letter_file->storeAs('documents/CourrierSortant/'.$courrierSortant->number, $fileName); // Store the file
                $data['letter_file'] = $filePath;
            }

            if ($request->accuse_reception_file != '') {

                Storage::delete('public/'.$courrierSortant->accuse_reception_file);

                $fileName_accuse_reception_file = time() . '.' . $request->accuse_reception_file->getClientOriginalExtension();
                $filePath_accuse_reception_file = $request->accuse_reception_file->storeAs('documents/CourrierSortant/'.$courrierSortant->number, $fileName_accuse_reception_file); // Store the file
                $data['accuse_reception_file'] = $filePath_accuse_reception_file;
            }

           

           

            $courrierSortant->update($data);

           return ['type'=>'success','message'=>'Enregistrement reussie'];


        } catch (\Throwable $th) {

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
