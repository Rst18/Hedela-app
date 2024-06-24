<?php

namespace App\Models;

use App\Models\Timesheet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnexeTimesheet extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','path','timesheet_id'];

     /**
     * Get the timesheet that owns the Annexetimesheet
     *
     * @return BelongsTo
     */
    public function timesheet(): BelongsTo
    {
        return $this->belongsTo(Timesheet::class);
    }

}
