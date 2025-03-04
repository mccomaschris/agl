<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
		'admin',
        'active',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
		'admin' => 'boolean',
		'active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'last_name',
    ];

    public function isAdmin(): bool
    {
        return (bool) $this->admin;
    }

    /**
     * Get the players for the year.
     */
    public function players(): HasMany
    {
        return $this->hasMany('App\Models\Player');
    }

    public function first_name(): ?string
    {
        $split = explode(' ', $this->name);

        return array_shift($split);
    }

    public function getLastNameAttribute(): string
    {
        if (! str_contains($this->name, ' ')) {
            return '';
        }

        $last_name = explode(' ', $this->name)[1];

        if ($last_name == 'McComas') {
            if (str_starts_with($this->name, 'M')) {
                return substr($this->name, 0, 2).'. '.$last_name;
            }

            return substr($this->name, 0, 1).'. '.$last_name;
        } elseif ($last_name == 'Baumgarner') {
            return substr($this->name, 0, 1).'. '.$last_name;
        } elseif ($last_name == 'Smith') {
            return substr($this->name, 0, 1).'. '.$last_name;
        } elseif ($last_name == 'Mills') {
            return substr($this->name, 0, 1).'. '.$last_name;
        } elseif ($last_name == 'Adkins') {
            return substr($this->name, 0, 1).'. '.$last_name;
        } else {
            return $last_name;
        }
    }
}
