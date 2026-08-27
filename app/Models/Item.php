<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'category_id', 'unit_id', 'description', 'balance', 'status'])]
class Item extends Model
{
    public const INACTIVE_STATUS = 0;
    public const ACTIVE_STATUS = 1;

    public const STATUS_TYPES = [
        self::INACTIVE_STATUS => 'Inactive',
        self::ACTIVE_STATUS => 'Active',
    ];

    public const OUT_OF_STOCK_STATUS = 0;
    public const IN_STOCK_STATUS = 1;

    public const STOCK_STATUS_TYPES = [
        self::OUT_OF_STOCK_STATUS => 'Out of Stock',
        self::IN_STOCK_STATUS => 'In Stock',
    ];

    public const NO_STOCK_LEVEL = 0;
    public const HIGH_STOCK_LEVEL = 5;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}