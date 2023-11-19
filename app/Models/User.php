<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";

    protected $fillable = [
        'uid',
        'name',
        'email',
        'password',
        'display_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() : BelongsToMany 
    {
        return $this->belongsToMany(Role::class, 'id', 'id');
    }

    public function contacts() : HasMany 
    {
        return $this->hasMany(Contact::class, 'created_by', 'id');
    }

    public function categories() : HasMany 
    {
        return $this->hasMany(Category::class, 'created_by', 'id');
    }

    public function invoiceDiscounts() : HasMany 
    {
        return $this->hasMany(InvoiceDiscount::class, 'created_by', 'id');
    }

    public function products() : HasMany 
    {
        return $this->hasMany(Product::class, 'created_by', 'id');
    }

    public function transactions() : HasMany 
    {
        return $this->hasMany(Transaction::class, 'created_by', 'id');
    }

    public function units() : HasMany 
    {
        return $this->hasMany(Unit::class, 'created_by', 'id');
    }
}
