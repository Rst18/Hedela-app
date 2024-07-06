<?php

namespace App\Models;

use App\Models\Reunion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdreJour extends Model
{
    use HasFactory;

    protected $fillable = ['name','reunion_id'];

    /**
     * Get the reunion that owns the OrdreJour
     *
     * @return BelongsTo
     */
    public function reunion(): BelongsTo
    {
        return $this->belongsTo(Reunion::class);
    }
}
