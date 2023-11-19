<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{
    use HasFactory;

    protected $table = "units";

    protected $fillable = [
        'name',
        'abbr',
        'short_description',
        'created_by',
    ];

    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }
}
