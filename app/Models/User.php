<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Menu;
use App\Models\Task;
use App\Models\Bureau;
use App\Models\Courrier;
use App\Models\Timesheet;
use App\Models\SondageItem;
use App\Models\RendezvousAudience;
use Illuminate\Notifications\Notifiable;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The roles that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * The courriers that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courriers(): BelongsToMany
    {
        return $this->belongsToMany(Courrier ::class);
    }

    /**
     * The rendezvous that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rendezvouss(): BelongsToMany
    {
        return $this->belongsToMany(RendezvousAudience::class);
    }


    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }


    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    /**
     * The bureaux that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bureaux(): BelongsToMany
    {
        return $this->belongsToMany(Bureau::class);
    }

    /**
     * The menus that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }

     /**
     * The aide_memoires that belong to the Reunion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function demande_parole(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'demande_parole_reunion');
    }

    /**
     * The sondages that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sondages(): BelongsToMany
    {
        return $this->belongsToMany(SondageItem::class);
    }


}
