<?php

namespace App\Models;

use App\Models\Courrier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnexeCourrier extends Model
{
    use HasFactory;

    protected $fillable = ['name','path','courrier_id'];

    /**
     * Get the courrier that owns the AnnexeCourrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }

}
