<?php

namespace App\Models;

use App\Models\Reunion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeReunion extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];

    /**
     * Get all of the reunions for the TypeReunion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reunions(): HasMany
    {
        return $this->hasMany(Reunion::class);
    }
}
