<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'status'])]
class Unit extends Model
{
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function scopeSearch($query, string $term)
    {
        $term = '%' . $term . '%';

        return $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term);
        });
    }
}