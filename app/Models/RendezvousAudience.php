<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezvousAudience extends Model
{
    use HasFactory;

    protected $fillable = ['audience_id','user_id','date_heure','lieu','status'];
}
