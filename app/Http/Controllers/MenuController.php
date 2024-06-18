<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Menu::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::with('menus')->get();
        $menus = Menu::all();
        return Inertia::render('Menu/Index',compact('users','menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        
        try {

            $new = Menu::create($request->validated());

            return ['type'=>'success','message'=>'Enregistrement reussi','new'=>$new];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec d\'enregistrement','errorMessage'=>$th];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return $menu;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return $menu;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        try {

           $menu->update($request->validated());

            return ['type'=>'error','message'=>'Modification reussie'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de modification','errorMessage'=>$th];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        try {

            $menu->delete();
            return ['type'=>'success','message'=>'Suppression reussi'];

        } catch (\Throwable $th) {
            //throw $th;
            return ['type'=>'error','message'=>'Echec de suppression'];
        }
    }

      /**
     * ATTRIBUTION DES MENUS AUX UTILISATEURS
     */

     public function addMenu(Request $request, User $user){  

        try {

            $user->menus()->attach($request->menu);

            return ['type'=>'success','message'=>'Enregistrement reussi'];            

        } catch (\Throwable $th) {

            return ['type'=>'error','message'=>"Echec d'enregistrement ",'errorMessage'=>$th];
        }
        
    }
    public function removeBureau(Request $request, User $user){  

        try {

            $user->menus()->detach($request->menu);

            return ['type'=>'success','message'=>'Enregistrement reussi'];            

        } catch (\Throwable $th) {

            return ['type'=>'error','message'=>"Echec d'enregistrement ",'errorMessage'=>$th];
        }
    }

    public function get_menu_user(){
       return  Auth::user()->menus;
    }
}
