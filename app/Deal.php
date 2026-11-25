<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use SoftDeletes;

    const STATUS_PENDING  = 'pending';
    const STATUS_DEPOSIT  = 'deposit';
    const STATUS_CONTRACT = 'contract';
    const STATUS_DONE     = 'done';
    const STATUS_CANCELED = 'canceled';

    protected $fillable = [
        'house_id', 'agent_id', 'seller_id', 'buyer_id',
        'deal_price', 'status', 'deal_type', 'signed_at',
    ];

    protected $dates = ['signed_at', 'deleted_at'];

    /**
     * The house involved in this deal.
     */
    public function house()
    {
        return $this->belongsTo(House::class);
    }

    /**
     * The agent handling this deal.
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * The seller.
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * The buyer.
     */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Get status label in Chinese.
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_PENDING  => '待处理',
            self::STATUS_DEPOSIT  => '已付定金',
            self::STATUS_CONTRACT => '已签合同',
            self::STATUS_DONE     => '交易完成',
            self::STATUS_CANCELED => '已取消',
        ];
        return $labels[$this->status] ?? $this->status;
    }
}
