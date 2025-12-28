<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'user_id',
        'total_amount',
        'payment_type',
        'status',
        'payment_status',
        'shipping_address',
        'billing_address'
    ];

    protected $casts = [
        'shipping_address' => 'array',
        'billing_address' => 'array'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
