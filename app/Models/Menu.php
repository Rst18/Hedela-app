<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name','path'];

    /**
     * The users that belong to the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The roles that belong to the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    static function get_user_menu(){

        $menus = [];

        $user = User::where('id',Auth::user()->id)->with(['roles'=>function($q){
            $q->with('menus');
        }])->first();

        

        foreach ($user->roles as $key => $role) {
            array_push($menus, $role->menus);
        }

        return $menus;
      
    }
}
