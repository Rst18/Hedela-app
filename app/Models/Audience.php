<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','phone','motif','user_id','user_requested','date_proposition','piece','status','fonction'
    ];

}
