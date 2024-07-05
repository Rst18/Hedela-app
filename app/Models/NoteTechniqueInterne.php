<?php

namespace App\Models;

use App\Models\CommentaireNoteInterne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NoteTechniqueInterne extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'faits',
        'analyse',
        'conclusion',
        'actions',
        'objet',
        'destinataire',
        'signataire',
        'copiea',
        'type_lettre',
        'annexe',
        'lettre',
        'user_id',
        'visible'

    ];

      /**
     * Get all of the commentaires for the NoteTechnique
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentaires(): HasMany
    {
        return $this->hasMany(CommentaireNoteInterne::class);
    }

    /**
     * Get all of the annexes for the NoteTechnique
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annexes(): HasMany
    {
        return $this->hasMany(AnnexeNoteTechniqueInterne::class);
    }
}
