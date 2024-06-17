<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batiment extends Model
{
    use HasFactory;

    protected $fillable = ['name','niveaux'];

    /**
     * Get all of the bureaux for the Batiment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bureaux(): HasMany
    {
        return $this->hasMany(Bureau::class);
    }
}
