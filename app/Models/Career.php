<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'advert_number',
        'description',
        'pdf_url',
        'status',
        'is_active',
        'posted_at',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'posted_at' => 'datetime',
            'closed_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }
}
