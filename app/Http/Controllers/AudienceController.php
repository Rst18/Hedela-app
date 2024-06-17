<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Audience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAudienceRequest;
use App\Http\Requests\UpdateAudienceRequest;

class AudienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Audience::select('audiences.*','users.name as autorite')
        ->with(['rendezvous'=>function($q){
            $q->with(['users'=>function($qry){
                $qry->with('roles');
            }]);
        }])
        ->join('users','users.id','audiences.user_requested')->paginate(10);
    }
    public function myList()
    {
        return Audience::select('audiences.*','users.name as autorite')
        ->with(['rendezvous'=>function($q){
            $q->with(['users'=>function($qry){
                $qry->with('roles');
            }]);
        }])
        ->join('users','users.id','audiences.user_requested')
        ->where('user_requested',Auth::user()->id)
        ->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users  = User::all();
        return Inertia::render('Audience/Index',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAudienceRequest $request)
    {
        try {

            $audience = Audience::create($request->validated());

            //Envoie de la notification a l'user_requested

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$audience];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'Enregisrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Audience $audience)
    {
        return $audience;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Audience $audience)
    {
        return $audience;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAudienceRequest $request, Audience $audience)
    {
        try {

            $audience->update($request->validated());
            return ['type'=>'success','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'success','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Audience $audience)
    {
        try {
            $audience->delete();
            return ['type'=>'success','message'=>'Suppression reussie'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'success','message'=>"Echec de suppression ",'errorMessage'=>$th];
        }
    }

    public function close(Audience  $audience){
        
        try {

            $audience->update(['status'=>4]);

            return ['type'=>'success','message'=>'Enregistrement reussi'];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec d\'Enregistrement','errorMessage'=>$th];
        }
    }

    public function list_protocole(){
        return Inertia::render('Audience/ListAudienceProtocole');
    }
    public function mes_audiences(){
        
        return Inertia::render('Audience/MesAudiences');
    }
    public function list_admin(){
        $users  = User::all();
        return Inertia::render('Audience/ListAudienceAdmin',compact('users'));
    }

    public function transfert(Request $request,Audience $audience){

        try {

            $user = User::find($request->user_id);
           
            if ($user != null) {
                
                $audience->update([
                    'user_requested'=> $user->id,
                    'audience_from'=>Auth::user()->id
                ]);

                return ['type'=>'success','message'=>'Audience Transferee'];

            }
            return ['type'=>'error','message'=>'Aucune information trouvee pour cet utilisateur'];


        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de transfert','errorMessage'=>$th];
        }
    }
    public function accept(Audience $audience){

        try {  
            
            $audience->update([
                'status'=>2
            ]);

            return ['type'=>'success','message'=>'Audience Transferee'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de transfert','errorMessage'=>$th];
        }
    }
    public function refuse(Audience $audience){

        try {  

            $audience->update([
                'status'=>1
            ]);

            return ['type'=>'success','message'=>'Audience Transferee'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de transfert','errorMessage'=>$th];
        }
    }
}
