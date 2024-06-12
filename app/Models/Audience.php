<?php

namespace App\Models;

use App\Models\RendezvousAudience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audience extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','phone','motif','user_id','user_requested','date_proposition','piece','status','fonction'
    ];

    /**
     * Get all of the rendezvous for the Audience
     *
     * @return HasMany
     */
    public function rendezvous(): HasMany
    {
        return $this->hasMany(RendezvousAudience::class);
    }
}
