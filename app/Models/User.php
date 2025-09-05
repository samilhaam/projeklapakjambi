<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'occupation',
        'bank_account',
        'avatar',
        'bank_name',
        'bank_account_number',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function isPelakuUmkm(){
        return $this->role === 'pelaku_umkm';
    }

    public function isPembeli(){
        return $this->role === 'pembeli';
    }

    public function isAdmin(){
        return $this->role === 'admin';
    }

    /**
     * Get all products created by this user
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'creator_id');
    }

    /**
     * Get all orders made by this user (as pembeli)
     */
    public function orders()
    {
        return $this->hasMany(ProductOrder::class, 'pembeli_id');
    }

    /**
     * Get all orders created by this user (as creator/seller)
     */
    public function createdOrders()
    {
        return $this->hasMany(ProductOrder::class, 'creator_id');
    }
}
