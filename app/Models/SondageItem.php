<?php

namespace App\Models;

use App\Models\User;
use App\Models\Sondage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

      /**
     * The users that belong to the Sondage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
