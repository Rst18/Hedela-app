<?php

namespace App\Models;

use App\Models\Batiment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bureau extends Model
{
    use HasFactory;

    protected $fillable = ['batiement_id','number','name','niveau'];

    /**
     * Get the batiment that owns the Bureau
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function batiment(): BelongsTo
    {
        return $this->belongsTo(Batiment::class);
    }

}
