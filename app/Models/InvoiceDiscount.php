<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceDiscount extends Model
{
    use HasFactory;

    protected $table = "invoice_discount";

    protected $casts = [
        'group_contact_id' => 'array',
    ];

    protected $fillable = [
        'name',
        'code',
        'type',
        'quantity',
        'rule_value',
        'value',
        'start_date',
        'end_date',
        'group_contact_id',
        'created_by'
    ];

    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }
}
