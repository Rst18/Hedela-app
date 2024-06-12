<?php

namespace App\Models;

use App\Models\Audience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RendezvousAudience extends Model
{
    use HasFactory;

    protected $fillable = ['audience_id','user_id','date_heure','lieu','status'];

    /**
     * Get the audience that owns the RendezvousAudience
     *
     * @return BelongsTo
     */
    public function audience(): BelongsTo
    {
        return $this->belongsTo(Audience::class);
    }
}
