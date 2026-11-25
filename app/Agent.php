<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'name', 'phone', 'email', 'agency',
        'license_no', 'avatar', 'description', 'rating',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The associated user account.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Houses listed by this agent.
     */
    public function houses()
    {
        return $this->hasMany(House::class);
    }

    /**
     * Deals handled by this agent.
     */
    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    /**
     * Get formatted rating.
     */
    public function getFormattedRatingAttribute()
    {
        return number_format($this->rating ?? 5.0, 1) . ' 分';
    }
}
