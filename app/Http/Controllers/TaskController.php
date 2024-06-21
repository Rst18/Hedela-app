<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::join('users','users.id','tasks.user_id')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Task/CreateTask');
    }
    public function task_dashbord()
    {
       // if (Role::test_group(['Admin','AdminBiblio','AdminDevs'])) {
            
            return Inertia::render('Task/Index');
       // } 
        return abort(403);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {

           // if (Group::test_group(['Admin','AdminBiblio','AdminDevs'])) {

                $task = Task::create($request->validated());

                // set the creator of this task as a keep inform
                $task->keepInformed()->attach(Auth::user()->id);

                return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$task];

            //} 

           // return abort(403);

        } catch (\Throwable $th) {
            
            return ['type'=>'error','message'=>'Echec d\'Enregistrement ','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)

    {
        try {
            
           // if (Group::test_group(['Admin','AdminBiblio','AdminDevs'])) {

                if ($task->user_id == Auth::user()->id) {
                    
                    $task->update($request->validated());
    
                    return ['type'=>'success','message'=>"Modification reussie"];
                    
                }   
                return ['type'=>'error','message'=>"Echec de modification, seul le createur de cette tache peut la modifiee"];
            //}
           // return abort(403);

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>"Echec de Modification",'errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {

            //if (Group::test_group(['Admin','AdminBiblio','AdminDevs'])) {

                if ($task->user_id == Auth::user()->id) {
                    
                    $task->delete();

                    return ['type'=>'success','message'=>'Suppression reussie'];
                }

                return ['type'=>'error','message'=>"Echec de suppression, seul le createur de cette tache peut la supprimee"];
           // }
        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Ecehc du Suppression','errorMessage'=>$th];
        }
    }


    
    public function addRoleTask(Request $request){
       
        try {
                   
            $role = Role::find($request->role);

            if ($role != null) {

                $role->tasks()->attach($request->task);

                return response()->json(data:[],status:200);
            }
            return response()->json(data:['Aucun group trouvé !'],status:404);

        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
      
    }
    public function removeRoleTask(Request $request){
      
        try {

            $role = Role::find($request->role);

            if ($role != null) {

                $role->tasks()->detach($request->task);

                return response()->json(data:[],status:200);
            }
            return response()->json(data:['Aucun group trouvé !'],status:404);

        } catch (\Throwable $th) {
            //throw $th;
        }
      
    }
    public function addUserTask(Request $request){
      
        try {

            $user = User::find($request->user);

            if ($user != null) {
                $user->tasks()->attach($request->task);
                // $user->tasks()->attach($request->task,['assigner' => Auth::user()->id]);
                $task = Task::find($request->task);
               // $user->notify(new TaskNotification($task->nom,Auth::user()->username,'Information'));
               // MailSend::sendMailToUser($user->email, Auth::user()->username ."Vous a affecter à une tache ( $tache->nom ), Veillez consulter la liste de vos taches.");
        
                return response()->json(data:[],status:200);
            }
            return response()->json(data:['Aucun group trouvé !'], status:404);

        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
      
    }
    public function removeUserTask(Request $request){

        try {

            $user = User::find($request->user);

            if ($user != null) {

                $user->tasks()->detach($request->task);

                return response()->json(data:[],status:200);
            }
            return response()->json(data:['Aucun group trouvé !'],status:404);

        } catch (\Throwable $th) {
            //throw $th;
        }
      
    }

    public function task_list()
    {

      
       
        $tasks = Task::with(['timesheets'=>function($q){
               // $q->join('users','users.id','timesheets.user_id');
            //->with('comments')
                }])
            ->with('users')
            ->with('keepInformed')
            ->with(['comments'=>function($query){
                    $query->join('users','users.id','task_comments.user_id');
                }])
            ->get();
           // return $tasks;
       
        return Inertia::render('Task/Tasks',compact('tasks'));
    }

    public function task_attrib_role()
    {
        $roles = Role::with('tasks')->get();
        $tasks =  Task::all();
        return Inertia::render('Task/ListGroupTask',compact('tasks','roles'));
    }

    public function role_user_tasks(){

        $roles =  Role::whereHas('tasks')
        ->with('tasks')
        ->with(['users'=>function($query){
            $query->with('tasks');
       }])->get();

       //return $groups;

       
       return Inertia::render('Task/ListRoleUsersTask',compact('roles'));
    }

  
    public function getMyTasksweb(){

        return User::where('id',Auth::user()->id)->with(['tasks'=>function($query){

            $query->with(['timesheets' => function($q){
                $q->join('users','users.id','timesheets.user_id');
                $q->with(['commentaires'=>function($q){
                    $q->join('users','users.id','timesheet_commentaires.user_id');
                }]);
            }])
            ->with('users')
            ->with('keepInformed')
            ->with(['comments'=>function($query){
                $query->join('users','users.id','task_comments.user_id');
            }]);
        }])->first();
       
    }
    public function my_tasks_page(){
        return Inertia::render('Task/MyTasks');
    }

    public function getStatistic(){
      $ouvertes =   Task::where('statut', 1)->count();
      $fermees =   Task::where('statut', 2)->count();
      $suspendues =   Task::where('statut', 3)->count();
      $total = Task::count();

      return ['total'=>$total,'ouvertes'=>$ouvertes,'fermees'=>$fermees,'suspendues'=>$suspendues];
    }

}
