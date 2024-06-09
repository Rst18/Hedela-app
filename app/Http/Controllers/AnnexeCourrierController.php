<?php

namespace App\Http\Controllers;

use App\Models\AnnexeCourrier;
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


            $fileName = time() . '.' . $request->annexe_file->getClientOriginalExtension();
            $courrier = Courrier::find($request->courrier_id)->number;
            $filePath = $request->letter_file->storeAs('documents/'.$courrier.'/Annexes/', $fileName);

            $data['path'] =  $filePath;
            AnnexeCourrier::create($data);
            
            return ['type'=>'success','message'=>'Enrgistrement reussi'];
        } catch (\Throwable $th) {
            //throw $th;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnexeCourrier $annexeCourrier)
    {
        //
    }
}
