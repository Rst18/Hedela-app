<?php

namespace App\Models;

use App\Models\TypeCourrier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'type_courrier_id',
        'status'
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

   /**
    * The users that belong to the Courrier
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function users(): BelongsToMany
   {
       return $this->belongsToMany(User::class);
   }
}
