<?php

namespace App\Models;

use App\Models\Courrier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeCourrier extends Model
{
    use HasFactory;

    protected $fillable = ['name','degre_urgence'];

    /**
     * Get all of the courriers for the TypeCourrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courriers(): HasMany
    {
        return $this->hasMany(Courrier::class);
    }
}
