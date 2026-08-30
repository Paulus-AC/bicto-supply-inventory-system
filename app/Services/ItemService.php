<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;

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

    public function getItem(int $itemId): Item
    {
        return Item::findOrFail($itemId);
    }

    public function fetchItemCategories()
    {
        return Category::where('status', Category::ACTIVE_STATUS)->get();
    }

    public function fetchItemUnits()
    {
        return Unit::where('status', Unit::ACTIVE_STATUS)->get();
    }
}