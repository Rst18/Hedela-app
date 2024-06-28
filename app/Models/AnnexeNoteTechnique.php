<?php

namespace App\Models;

use App\Models\NoteTechnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnexeNoteTechnique extends Model
{
    use HasFactory;

    protected $fillable = ['name','path','note_technique_id'];


    /**
     * Get the noteTechnique that owns the AnnexeNoteTechnique
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function noteTechnique(): BelongsTo
    {
        return $this->belongsTo(NoteTechnique::class);
    }


}
