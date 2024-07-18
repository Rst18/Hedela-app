<?php

namespace App\Http\Controllers;

use App\Models\SodageItem;
use App\Models\SondageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSondageItemRequest;
use App\Http\Requests\UpdateSondageItemRequest;

class SondageItemController extends Controller
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
    public function store(StoreSondageItemRequest $request)
    {
        try {

            $item = SondageItem::create($request->validated());
            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$item];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'Enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SondageItem $sondageItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SondageItem $sondageItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSondageItemRequest $request, SondageItem $sondageItem)
    {
        try {

            $sondageItem->update($request->validated());
            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SondageItem $sondageItem)
    {
        try {
            $sondageItem->delete();
            return ['type'=>'success','message'=>'Suppression reussie'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }

    public function addVoteSondage(Request $request){

        try {

            $sondage_item = SondageItem::find($request->sondage_item);

            if ($sondage_item != null) {

                $sondage_item->users()->attach(Auth::user()->id);

                // lancement de l'evenement

                
                return response()->json(data:[],status:200);
            }
            return response()->json(data:['Aucun Sondage trouvé !'],status:404);

        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }

    }
    public function removeVoteSondage(Request $request){

        try {

            $sondage_item = SondageItem::find($request->sondage_item);

            if ($sondage_item != null) {

                $sondage_item->users()->detach(Auth::user()->id);

                return response()->json(data:[],status:200);
            }
            return response()->json(data:['Aucun Sondage trouvé !'],status:404);

        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }

    }
}
