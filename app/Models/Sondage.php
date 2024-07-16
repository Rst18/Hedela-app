<?php

namespace App\Models;

use App\Models\Reunion;
use App\Models\SondageItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * Get all of the sondageItems for the Sondage
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sondageItems(): HasMany
    {
        return $this->hasMany(SondageItem::class);
    }

  
}
