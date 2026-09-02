<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;

class ItemService
{
    /**
     * Get the filter data for items.
     *
     * @return array
     */
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

    /**
     * Get the item listings based on search and filters.
     *
     * @param string $search
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getItemListings(string $search, array $filters)
    {
        $items = Item::with(['category', 'unit'])
            ->when(isset($search) && !empty($search), function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    query_search($query, $search, ['name', 'category.name', 'unit.name', 'balance']);
                });
            })->when(isset($filters) && !empty($filters), function ($query) use ($filters) {
                $query->where(function ($query) use ($filters) {
                    query_filter($query, $filters, $this->getFilterItemData());
                });
            })->when(!isset($filters['archived']) || !$filters['archived'], function ($query) {
                $query->where('status', Item::ACTIVE_STATUS);
            });
    
        return $items;
    }

    /**
     * Get a specific item by its ID.
     *
     * @param int $itemId
     * @return Item
     */
    public function getItem(int $itemId): Item
    {
        return Item::findOrFail($itemId);
    }

    /**
     * Create a new item with the given payload.
     *
     * @param array $payload
     * @return Item
     */
    public function createItem(array $payload): Item
    {
        return Item::create($payload);
    }

    /**
     * Update an existing item with the given payload.
     *
     * @param Item $item
     * @param array $payload
     * @return bool
     */
    public function updateItem(Item $item, array $payload): bool
    {
        return $item->update($payload);
    }

    /**
     * Get all active item categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchItemCategories()
    {
        return Category::where('status', Category::ACTIVE_STATUS)->get();
    }

    /**
     * Get all active item units.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchItemUnits()
    {
        return Unit::where('status', Unit::ACTIVE_STATUS)->get();
    }
}