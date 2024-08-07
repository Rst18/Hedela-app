<?php

namespace App\Http\Controllers;

use App\Models\Courrier;
use App\Models\AnnexeCourrier;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAnnexeCourrierRequest;
use App\Http\Requests\UpdateAnnexeCourrierRequest;

class AnnexeCourrierController extends Controller
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
    public function store(StoreAnnexeCourrierRequest $request)
    {
        try {

            $data = $request->validated();


            $fileName = time() . '.' . $request->path->getClientOriginalExtension();
            $courrier = Courrier::find($request->courrier_id)->number;
            $filePath = $request->path->storeAs('documents/'.$courrier.'/Annexes/', $fileName);

            $data['path'] =  $filePath;
            AnnexeCourrier::create($data);

            return ['type'=>'success','message'=>'Enrgistrement reussi'];
        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec d\'Enrgistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AnnexeCourrier $annexeCourrier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnnexeCourrier $annexeCourrier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnexeCourrierRequest $request, AnnexeCourrier $annexeCourrier)
    {
        try {


            $data = $request->validated();

            if ($request->path !='') {

                Storage::delete('public/'.$annexeCourrier->path);
               
                $fileName = time() . '.' . $request->path->getClientOriginalExtension();
                $courrier = Courrier::find($request->courrier_id)->number;
                $filePath = $request->path->storeAs('documents/'.$courrier.'/Annexes/', $fileName);
    
                $data['path'] =  $filePath;
            }

            $annexeCourrier->update($data);

            return ['type'=>'success','message'=>'Modification reussie'];


        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnexeCourrier $annexeCourrier)
    {
        //
    }
}
