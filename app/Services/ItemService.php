<?php

namespace App\Services;

use App\Models\Item;

class ItemService
{
    public function getFilterItemData()
    {
        return [
            'in_stock' => [
                'type' => 'or',
                'condition' => "balance > " . Item::NO_STOCK_LEVEL
            ],
            'out_of_stock' => [
                'type' => 'or',
                'condition' => "balance <= " . Item::NO_STOCK_LEVEL
            ],
            'archived' => [
                'type' => 'or',
                'condition' => "status = " . Item::INACTIVE_STATUS
            ],
        ];
    }
}