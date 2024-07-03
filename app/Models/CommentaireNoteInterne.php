<?php

namespace App\Models;

use App\Models\NoteTechniqueInterne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentaireNoteInterne extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','note_technique_interne_id','commentaire','commentaireParent'];

    /**
     * Get the noteTechnique that owns the CommentaireNoteTechnique
     *
     * @return BelongsTo
     */
    public function noteTechnique(): BelongsTo
    {
        return $this->belongsTo(NoteTechniqueInterne::class);
    }
}
