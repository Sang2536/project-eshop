<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        'name',
        'code',
        'parent_id',
        'type',
        'slug',
        'description',
        'created_by',
    ];

    public function products() : HasMany 
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }
}
