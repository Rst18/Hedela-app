<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTimesheetRequest;
use App\Http\Requests\UpdateTimesheetRequest;

class TimesheetController extends Controller
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
    public function store(StoreTimesheetRequest $request)
    {
        //return $request;
        // $request->letter_file->getClientOriginalExtension();
        try {

            $task = Task::find($request->task_id);
            if ($task->statut = 1) {


                $timesheet = Timesheet::create($request->validated());

                // if ($request->annexes) {

                //     for ($i=0; $i < count($request->annexes); $i++) {

                //         $fileName = time() . '.' . $request->path->getClientOriginalExtension();
                //         $filePath = $request->path->storeAs('timesheets/'.$request->timesheet_id.'/Annexes/', $fileName);

                //         $data['path'] =  $filePath;
                //         AnnexeTimesheet::create($data);
                //     }
                // }

                //notification Keep Informed
                return ['type'=>'success',',message'=>'Enregistrement reussi','new'=>$timesheet];
            }
            
            return ['type'=>'success',',message'=>'Impossible d\'enregistrer un rapport sur cette tache, verifiez qu\'elle n\'est pas fermee ou suspendue'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Timesheet $timesheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timesheet $timesheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimesheetRequest $request, Timesheet $timesheet)
    {

         try {

            if ($timesheet->user_id == Auth::user()->id) {

                $timesheet->update($request->validated());

                return ['type'=>'success','message'=>'Modification reussie'];
            }

            return ['type'=>'error','message'=>'Echec de Modification, seul le propriétaire de ce Timesheet peut le modifié'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timesheet $timesheet)
    {
        try {

            if ($timesheet->user_id == Auth::user()->id) {

                $timesheet->delete();

                return ['type'=>'success','message'=>'Suppression reussie'];
            }

            return ['type'=>'error','message'=>'Echec de Modification, seul le propriétaire de ce Timesheet peut le supprimé'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression','errorMessage'=>$th];
        }
    }


    public function getMyTimesheetsForTask($tache){

        return  Tache::where('id',$tache)->with(['timesheets'=>function($query){
           $query->where('user_id',Auth::user()->id );
       }])->first();

   }

   public function getMyTimesheetsForTask_mobile($user,$tache){

        return  Tache::where('id',$tache)->with(['timesheets'=>function($query) use ($user){
           $query->where('user_id',$user );
       }])->first();

   }
   public function getTimesheetsForTask($tache){

       $task = Tache::where('id',$tache)->first();

       if ($task != null) {
           return $task->with(['timesheets'=>function($query){
                               $query->join('users','users.id','timesheets.user_id');
                           } ])->first();
       }
   }
   public function getTimesheet($tache){

       $user = User::find(Auth::user()->id);

       if ($user != null) {

           return $user->with(['timesheets'=>function($query) use ($tache){
                   $query->where('id',$tache);
               }])->get();
       }
   }
   public function getTimesheetUser(User $user,Tache $tache){

       return $user->with(['timesheets'=>function($query) use ($tache){
               $query->where('id',$tache);
           }])->get();

   }
}
