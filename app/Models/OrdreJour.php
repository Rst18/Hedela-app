<?php

namespace App\Models;

use App\Models\Reunion;
use App\Models\AnnexeOrdreJour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdreJour extends Model
{
    use HasFactory;

    protected $fillable = ['name','reunion_id','description'];

    /**
     * Get the reunion that owns the OrdreJour
     *
     * @return BelongsTo
     */
    public function reunion(): BelongsTo
    {
        return $this->belongsTo(Reunion::class);
    }

    /**
     * Get all of the annexes for the OrdreJour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annexes(): HasMany
    {
        return $this->hasMany(AnnexeOrdreJour::class);
    }
}
