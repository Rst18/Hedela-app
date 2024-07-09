<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use App\Models\OrdreJour;
use App\Models\AideMemoire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reunion extends Model
{
    use HasFactory;

    protected $fillable = ['id','description','lien_zoom','lien_youtube','date_debut','date_fin','status','user_id'];

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';


    static function genereNumReunionID (){
        
        $last_id = Reunion::latest('id')->first();

        if ($last_id !== null) {

            return 'AN-R/'.explode('R/',$last_id->id)[1] + 1;

        }else return 'AN-R/'.substr(date("Y"),2).'0000000001';
    }




    /**
     * Get all of the ordresDuJour for the Reunion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordresDuJour(): HasMany
    {
        return $this->hasMany(OrdreJour::class);
    }


      
   

    /**
     * The orateurs that belong to the Reunion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orateurs(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'reuion_orateur');
    }

    /**
     * The aide_memoires that belong to the Reunion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function demande_parole(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'demande_parole_reunion');
    }
   
    /**
     * Get all of the aides_memoire for the Reunion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aides_memoire(): HasMany
    {
        return $this->hasMany(AideMemoire::class);
    }

     /**
     * The aide_memoire_reunion_role that belong to the Reunion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function aide_memoire_reunion_role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'aide_memoire_reunion_role');
    }


     /**
     * The participant_reunion_role that belong to the Reunion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function participant_reunion_role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'participant_reunion_role');
    }


     /**
     * The preside_reunion_role that belong to the Reunion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function preside_reunion_role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'preside_reunion_role');
    }

   
}
