<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'item_type',
        'item_id',
        'quantity',
        'payment_option',
        'payable_amount',
        'selected_color',
        'selected_size'
    ];
}
