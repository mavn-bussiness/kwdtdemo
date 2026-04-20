<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'awarding_organization',
        'description',
        'image_url',
        'order',
    ];

    protected $casts = [
        'year' => 'integer',
        'order' => 'integer',
    ];

    public function imageUrl(): ?string
    {
        if (empty($this->image_url)) {
            return null;
        }

        if (str_starts_with($this->image_url, 'http')) {
            return $this->image_url;
        }

        return asset('storage/' . ltrim($this->image_url, '/'));
    }
}
