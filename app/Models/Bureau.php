<?php

namespace App\Models;

use App\Models\User;
use App\Models\Batiment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bureau extends Model
{
    use HasFactory;

    protected $fillable = ['batiment_id','number','name','niveau'];

    /**
     * Get the batiment that owns the Bureau
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function batiment(): BelongsTo
    {
        return $this->belongsTo(Batiment::class);
    }

    /**
     * The users that belong to the Bureau
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

}
