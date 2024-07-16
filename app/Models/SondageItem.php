<?php

namespace App\Models;

use App\Models\Sondage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SondageItem extends Model
{
    use HasFactory;

    protected $fillable = ['sondage_id','description'];

    /**
     * Get the sondage that owns the SodageItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sondage(): BelongsTo
    {
        return $this->belongsTo(Sondage::class);
    }
}
