<?php

namespace App\Models;

use App\Models\TypeCourrier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courrier extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'sender',
        'email',
        'phone',
        'objet',
        'letter_number',
        'annexes',
        'letter_file',
        'service_id',
        'type_courrier_id'
    ];

   /**
    * Get the typeCourrier that owns the Courrier
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function typeCourrier(): BelongsTo
   {
       return $this->belongsTo(TypeCourrier::class, 'foreign_key', 'other_key');
   }
}
