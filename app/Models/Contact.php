<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $table = "contacts";

    protected $fillable = [
        'cid',
        'name',
        'prefix',
        'address',
        'phone',
        'email',
        'photo',
        'status',
        'type',
        'rank',
        'created_by'
    ];

    protected $hidden = [
        'password',
    ];

    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

    public function transactions() : HasMany 
    {
        return $this->hasMany(Transaction::class, 'contact_id', 'id');
    }
}
