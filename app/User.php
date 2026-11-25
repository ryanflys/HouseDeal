<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_AGENT = 'agent';
    const ROLE_USER  = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Check if the user is an agent.
     *
     * @return bool
     */
    public function isAgent()
    {
        return $this->role === self::ROLE_AGENT;
    }

    /**
     * Houses listed by this user.
     */
    public function houses()
    {
        return $this->hasMany(House::class, 'user_id');
    }

    /**
     * Favorites of this user.
     */
    public function favorites()
    {
        return $this->belongsToMany(House::class, 'favorites')->withTimestamps();
    }
}
