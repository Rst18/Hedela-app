<?php

namespace App\Models;

use App\Models\Reunion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sondage extends Model
{
    use HasFactory;

    protected $fillable = ['reunion_id','user_id','description','status'];

    /**
     * Get the reunion that owns the Sondage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reunion(): BelongsTo
    {
        return $this->belongsTo(Reunion::class);
    }
}
