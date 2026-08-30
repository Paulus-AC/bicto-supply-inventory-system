<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'status'])]
class Category extends Model
{
    public const INACTIVE_STATUS = 0;
    public const ACTIVE_STATUS = 1;

    public const STATUS_TYPES = [
        self::INACTIVE_STATUS => 'Inactive',
        self::ACTIVE_STATUS => 'Active',
    ];
    
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function scopeSearch(Builder $query, string $term)
    {
        $term = '%' . $term . '%';

        return $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term);
        });
    }
}