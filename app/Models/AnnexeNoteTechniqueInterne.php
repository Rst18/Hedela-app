<?php

namespace App\Models;

use App\Models\NoteTechniqueInterne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnexeNoteTechniqueInterne extends Model
{
    use HasFactory;
    protected $fillable = ['name','path','note_technique_interne_id'];


    /**
     * Get the noteTechnique that owns the AnnexeNoteTechnique
     *
     * @return BelongsTo
     */
    public function noteTechnique(): BelongsTo
    {
        return $this->belongsTo(NoteTechniqueInterne::class);
    }
}
