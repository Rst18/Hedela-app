<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrdreJour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reunion extends Model
{
    use HasFactory;

    protected $fillable = ['code','description','lien_zoom','lien_youtube','date_debut','date_fin','status','user_id'];

    // protected $primaryKey = 'id';

    /**
     * Get all of the ordresDuJour for the Reunion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordresDuJour(): HasMany
    {
        return $this->hasMany(OrdreJour::class);
    }


      
    // Reunion model
    public function orateurs()
    {
        return $this->belongsToMany(User::class, 'reuion_orateur');
    }

   
}
