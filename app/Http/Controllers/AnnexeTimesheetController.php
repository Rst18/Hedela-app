<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Models\AnnexeTimesheet;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAnnexeTimesheetRequest;
use App\Http\Requests\UpdateAnnexeTimesheetRequest;

class AnnexeTimesheetController extends Controller
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
    public function store(StoreAnnexeTimesheetRequest $request)
    {
        try {

            $data = $request->validated();


            $fileName = time() . '.' . $request->path->getClientOriginalExtension();
            $filePath = $request->path->storeAs('timesheets/'.$request->timesheet_id.'/Annexes/', $fileName);

            $data['path'] =  $filePath;
            AnnexeTimesheet::create($data);

            return ['type'=>'success','message'=>'Enrgistrement reussi'];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec d\'Enrgistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AnnexeTimesheet $annexeTimesheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnnexeTimesheet $annexeTimesheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnexeTimesheetRequest $request, AnnexeTimesheet $annexeTimesheet)
    {
        try {

            $data = $request->validated();


            $fileName = time() . '.' . $request->path->getClientOriginalExtension();
            $filePath = $request->path->storeAs('timesheets/'.$request->timesheet_id.'/Annexes/', $fileName);

            $data['path'] =  $filePath;

            $annexeTimesheet->update($data);

            return ['type'=>'success','message'=>'Enrgistrement reussi'];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec d\'Enrgistrement','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnexeTimesheet $annexeTimesheet)
    {
        try {

            $annexeTimesheet->delete();
            return ['type'=>'success','message'=>'Suppression reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression'];
        }
    }

    public function downloadFile($id){

        try {
            // telechargement de la ressourece
            return Storage::download(str_replace('++','/',$id));
        } catch (\Throwable $th) {
            //throw $th; 
            return "Une erreur est survennue lors du téléchargement, veillez réessayer plus tard";
        }
    }
}
