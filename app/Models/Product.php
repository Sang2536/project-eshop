<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'name',
        'sku',
        'category_id',
        'type',
        'quantity',
        'unit_id',
        'price_buy',
        'price_sale',
        'photo',
        'short_description',
        'created_by',
    ];

    public function user() : BelongsTo 
    {
        // return $this->hasOne(Name Model, 'foreign_key' của Name Model, cột Liên kêt foreign_key của table hiện tại);
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

    public function category() : BelongsTo 
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }
}
