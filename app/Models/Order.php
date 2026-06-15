<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',

        'payment_status',
        'payment_method',
        'paid_at',

        'shipping_status',

        'payment_proof',
        'tracking_number',

        'receiver_name',
        'phone',
        'shipping_address',

        'status',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}