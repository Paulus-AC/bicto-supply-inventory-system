<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['item_id', 'user_id', 'type', 'quantity', 'requested_by', 'remarks'])]
class Transaction extends Model
{
    public const IN_TYPE = 1;
    public const OUT_TYPE = 2;
    public const ADJUST_TYPE = 3;
    public const TRANSACTION_TYPES = [
        self::IN_TYPE => 'Stock In',
        self::OUT_TYPE => 'Stock Out',
        self::ADJUST_TYPE => 'Adjustment',
    ];

    /**
     * Get the item that owns the transaction.
     * @return BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get the user that owns the transaction.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}