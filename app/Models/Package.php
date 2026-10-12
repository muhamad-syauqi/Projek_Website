<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'price',
        'description',
        'image',
        'facilities',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'facilities' => 'array',
            'is_active' => 'boolean',
            'price' => 'integer',
        ];
    }
}
