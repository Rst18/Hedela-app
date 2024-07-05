<?php

namespace App\Models;

use App\Models\CourrierSortant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourrierSortant extends Model
{
    use HasFactory;

    protected $fillable = ['number','requested','letter_file','user_id','accuse_reception_file','courrier_id'];

    static function genereNumCourrier (){
        
        $last_number = CourrierSortant::latest('number')->first();

        if ($last_number !== null) {

            return 'DevRl-'.explode('-',$last_number->number)[1] + 1;

        }else return 'DevRl-'.substr(date("Y"),2).'0000000001';
    }

}
