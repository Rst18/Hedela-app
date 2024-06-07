<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentaireCourrier extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','courrier_id','commentaire','commentaireParent'];


    /**
     * Get the courrier that owns the CommentaireCourrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }
}
