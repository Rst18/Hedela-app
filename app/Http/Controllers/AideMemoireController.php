<?php

namespace App\Http\Controllers;

use App\Models\AideMemoire;
use App\Events\AideMemoireSent;
use App\Http\Requests\StoreAideMemoireRequest;
use App\Http\Requests\UpdateAideMemoireRequest;

class AideMemoireController extends Controller
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
    public function store(StoreAideMemoireRequest $request)
    {
        try {

            $new = AideMemoire::create($request->validated());

            broadcast(new AideMemoireSent($new));

            return ['type'=>'success','message'=>'Enregistrement reussie','new'=>$new];

        } catch (\Throwable $th) {
            //throw $th;

            return ['type'=>'error','message'=>'Echec d\'Enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AideMemoire $aideMemoire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AideMemoire $aideMemoire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAideMemoireRequest $request, AideMemoire $aideMemoire)
    {
        try {

            $aideMemoire->update($request->validated());

            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;

            return ['type'=>'error','message'=>'Echec de modification'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AideMemoire $aideMemoire)
    {
        try {

            $aideMemoire->delete();

            return ['type'=>'success','message'=>'Suppresssion reussie'];

        } catch (\Throwable $th) {
            //throw $th;

            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }

    public function markAsRead(AideMemoire $aideMemoire){
        try {
            $aideMemoire->update(['status'=>1]);
            return ['type'=>'success','message'=>'Suppresssion reussie'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }
}
