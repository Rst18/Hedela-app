<?php

namespace App\Models;

use App\Models\Role;
use App\Models\TaskComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['nom','description','statut','statut_resolution','priorite','date_limite','user_id'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all of the timesheets for the Tache
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(TaskComment::class);
    }

    
    // Task model
    public function keepInformed()
    {
        return $this->belongsToMany(User::class, 'task_keep_informed');
    }

    
}
