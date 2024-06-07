<?php

namespace App\Models;

use App\Models\Courrier;
use Illuminate\Database\Eloquent\Model;
use App\Models\CommentaireNoteTechnique;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NoteTechnique extends Model
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
       'annexes',
        'lettre',
        'user_id',
        'courrier_id'
    ];

    /**
     * Get the courrier that owns the NoteTechnique
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }

    /**
     * Get all of the commentaires for the NoteTechnique
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentaires(): HasMany
    {
        return $this->hasMany(CommentaireNoteTechnique::class);
    }
}
