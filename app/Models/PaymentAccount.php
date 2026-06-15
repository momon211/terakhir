<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'bank',
        'account_number',
        'pin',
    ];

    protected $hidden = [
        'pin',
    ];

    /**
     * Relasi akun pembayaran milik satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}