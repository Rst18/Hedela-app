<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    use HasFactory;

    protected $fillable = ['code','description','lien_zoom','lien_youtube','date_debut','date_fin','status','user_id'];

   
}
