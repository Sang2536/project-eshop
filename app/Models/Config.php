<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $table = "configs_website";

    protected $casts = [
        'background' => 'array',
        'font' => 'array',
    ];

    protected $fillable = [
        'name',
        'status',
        'logo',
        'logo_icon',
        'description',
        'background',
        'font',
    ];
}
