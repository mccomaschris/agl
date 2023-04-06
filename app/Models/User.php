<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'last_name',
    ];

    public function isAdmin()
    {
        return !!$this->admin;
    }

    public function getAvatarPathAttribute($avatar)
    {
        return $avatar ? '/storage/' . $avatar : '/images/man.jpg';
    }

    /**
     * Get the players for the year.
     */
    public function players()
    {
        return $this->hasMany('App\Player');
    }

    public function first_name()
    {
        $split = explode(" ", $this->name);
        return array_shift($split);
    }

    public function getLastNameAttribute()
    {
		if ( ! str_contains($this->name, ' ') ) {
			return '';
		}

        $last_name = explode(" ", $this->name)[1];

        if ($last_name == 'McComas') {
            if (substr($this->name, 0, 1) == 'M') {
                return substr($this->name, 0, 2) . ". " . $last_name;
            }
            return substr($this->name, 0, 1) . ". " . $last_name;
        }
        elseif ($last_name == 'Baumgarner') {
            return substr($this->name, 0, 1) . ". " . $last_name;
        }
        elseif ($last_name == 'Smith') {
            return substr($this->name, 0, 1) . ". " . $last_name;
        }
        elseif ($last_name == 'Mills') {
            return substr($this->name, 0, 1) . ". " . $last_name;
        }
		elseif ($last_name == 'Adkins') {
            return substr($this->name, 0, 1) . ". " . $last_name;
        }
        else {
            return $last_name;
        }
    }
}
