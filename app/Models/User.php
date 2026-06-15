<?php

namespace App\Models;

use App\Models\Order;
use App\Models\PaymentAccount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast atribut.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi user memiliki banyak pesanan.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relasi user memiliki satu akun pembayaran.
     */
    public function paymentAccount()
    {
        return $this->hasOne(PaymentAccount::class);
    }

    /**
     * Cek apakah user adalah admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah user biasa.
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }
}