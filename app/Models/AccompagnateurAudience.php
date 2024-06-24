<?php

namespace App\Models;

use App\Models\Audience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccompagnateurAudience extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','audience_id'];

    /**
     * Get the audience that owns the AccompagnateurAudience
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function audience(): BelongsTo
    {
        return $this->belongsTo(Audience::class);
    }
}
