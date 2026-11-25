<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use SoftDeletes;

    const STATUS_SALE    = 'sale';
    const STATUS_SOLD    = 'sold';
    const STATUS_RENT    = 'rent';
    const STATUS_RENTED  = 'rented';
    const STATUS_OFFLINE = 'offline';

    const TYPE_NEW      = 'new';
    const TYPE_SECOND   = 'second';
    const TYPE_RENT     = 'rent';

    protected $fillable = [
        'user_id', 'title', 'description', 'price', 'rent_price',
        'type', 'status', 'city', 'district', 'address', 'area',
        'bedrooms', 'living_rooms', 'bathrooms', 'floor', 'total_floor',
        'orientation', 'decoration', 'images', 'is_featured',
    ];

    protected $casts = [
        'images'      => 'array',
        'is_featured' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the lister of this house.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the agent of this house.
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * Get the deals associated with this house.
     */
    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    /**
     * Users who favorited this house.
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    /**
     * Scope a query to only include houses of a given status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include featured houses.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get the cover image.
     */
    public function getCoverAttribute()
    {
        if (!empty($this->images) && is_array($this->images)) {
            return $this->images[0];
        }
        return '/img/default-house.png';
    }

    /**
     * Get formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        if ($this->price >= 10000) {
            return number_format($this->price / 10000, 2) . ' 万';
        }
        return number_format($this->price) . ' 元';
    }
}
