<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $casts = [
        'details_payment' => 'array'
    ];

    protected $fillable = [
        'code',
        'contact_id',
        'total_amount',
        'transaction_date',
        'transaction_type',
        'payment_amount',
        'payment_type',
        'payment_status',
        'payment_date_ends',
        'details_payment',
        'code_invoice_discount',
        'note',
        'created_by',
    ];

    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

    public function contact() : BelongsTo 
    {
        return $this->belongsTo(Contact::class, 'id', 'contact_id');
    }
}
