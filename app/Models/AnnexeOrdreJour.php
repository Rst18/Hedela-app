<?php

namespace App\Models;

use App\Models\OrdreJour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnexeOrdreJour extends Model
{
    use HasFactory;

    protected $fillable = ['name','filePath'];

    /**
     * Get the ordreJour that owns the AnnexeOrdreJour
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ordreJour(): BelongsTo
    {
        return $this->belongsTo(OrdreJour::class);
    }
}
