<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionProduct extends Model
{
    use HasFactory;

    protected $table = "transaction_products";

    protected $fillable = [
        'transaction_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity',
    ];

    public function transaction() : BelongsTo 
    {
        return $this->belongsTo(Transaction::class, 'id', 'transaction_id');
    }
}
