<?php

namespace App\Models;

use App\Models\Reunion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AideMemoire extends Model
{
    use HasFactory;

    protected $fillable = ['reunion_id','message','user_id'];

    /**
     * Get the reunion that owns the AideMemoire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reunion(): BelongsTo
    {
        return $this->belongsTo(Reunion::class);
    }
}
