<?php

namespace App\Livewire\Items;

use App\Livewire\BaseComponent;
use App\Services\ItemService;
use Livewire\Attributes\On;

class Listing extends BaseComponent
{
    private ItemService $itemService;

    public array $filters = [
        'in_stock' => false,
        'out_of_stock' => false,
        'archived' => false,
    ];

    public string $sortBy = 'balance';

    /**
     * Boot the component with the ItemService.
     * 
     * @param ItemService $itemService 
     */
    public function boot(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * Render the component.
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $items = $this->fetchItemListings();

        return view('livewire.items.listing', [
            'items' => $items,
        ]);
    }

    /**
     * Refresh the items when an item is created or updated.
     *
     * @return void
     */
    #[On('item-created')]
    #[On('item-updated')]
    public function refreshItems(): void 
    {

    }

    /**
     * Handle the updated filters for in_stock and out_of_stock.
     *
     * @param bool $value
     * @return void
     */
    public function updatedFiltersInStock(bool $value): void
    {
        if ($value) {
            $this->filters['out_of_stock'] = false;
        }

        $this->resetPage();
    }

    /**
     * Handle the updated filters for out_of_stock and in_stock.
     *
     * @param bool $value
     * @return void
     */
    public function updatedFiltersOutOfStock(bool $value): void
    {
        if ($value) {
            $this->filters['in_stock'] = false;
        }

        $this->resetPage();
    }

    /**
     * Fetch the item listings based on search and filters.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function fetchItemListings()
    {
        $paginatedItems = $this->itemService->getItemListings($this->search, $this->filters)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(self::PER_PAGE);

        return $paginatedItems;
    }
}
