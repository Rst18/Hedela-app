<?php

namespace App\Models;

use App\Models\RendezvousAudience;
use App\Models\AccompagnateurAudience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audience extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','phone','motif','user_id','user_requested','date_proposition','piece','status','fonction','interne','audience_from'
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

    /**
     * Get all of the accompagnateurs for the Audience
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accompagnateurs(): HasMany
    {
        return $this->hasMany(AccompagnateurAudience::class);
    }
}
