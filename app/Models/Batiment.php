<?php

namespace App\Models;

use App\Models\Bureau;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
