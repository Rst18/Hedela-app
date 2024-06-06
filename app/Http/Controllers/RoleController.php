<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Role::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $users = User::with('roles')->get();
        return Inertia::render('Role/Index',compact('roles','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {

            $role = Role::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$role];

        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec d\'Enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return $role;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return $role;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {

            $role->update($request->validated());
            
            return ['type'=>'success','message'=>'Modification reussie'];
        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec de Modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            
            return ['type'=>'success','message'=>'Suppression reussie'];
        } catch (\Throwable $th) {
            //throw $th;
            
            return ['type'=>'error','message'=>'Echec de suppression'];
        }
    }


    /**
     * ATTRIBUTION DES ROLES AUX UTILISATEURS
     */

    public function addRoles(Request $request, User $user){  

        try {

            $user->roles()->attach($request->role);

            return ['type'=>'success','message'=>'Enregistrement reussi'];            

        } catch (\Throwable $th) {

            return ['type'=>'error','message'=>"Echec d'enregistrement ",'errorMessage'=>$th];
        }
        
    }
    public function removeRoles(Request $request, User $user){  

        try {

            $user->roles()->detach($request->role);

            return ['type'=>'success','message'=>'Enregistrement reussi'];            

        } catch (\Throwable $th) {

            return ['type'=>'error','message'=>"Echec d'enregistrement ",'errorMessage'=>$th];
        }
    }
}
