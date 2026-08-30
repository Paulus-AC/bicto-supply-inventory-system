<?php

namespace App\Livewire\Items;

use App\Livewire\BaseComponent;
use App\Models\Item;
use App\Services\ItemService;
use Livewire\Attributes\On;

class Listing extends BaseComponent
{
    public array $filters = [
        'in_stock' => false,
        'out_of_stock' => false,
        'archived' => false,
    ];

    public string $sortBy = 'balance';

    public function render()
    {
        $items = $this->fetchItemListings();

        return view('livewire.items.listing', [
            'items' => $items,
        ]);
    }

    #[On('item-created')]
    #[On('item-updated')]
    public function refreshItems(): void 
    {

    }

    public function updatedFiltersInStock(bool $value): void
    {
        if ($value) {
            $this->filters['out_of_stock'] = false;
        }

        $this->resetPage();
    }

    public function updatedFiltersOutOfStock(bool $value): void
    {
        if ($value) {
            $this->filters['in_stock'] = false;
        }

        $this->resetPage();
    }

    private function fetchItemListings()
    {
        $items = Item::with(['category', 'unit'])
            ->when(isset($this->search), function ($query) {
                $query->where(function ($query) {
                    $this->searchCallback($query, $this->search, ['name', 'category.name', 'unit.name', 'balance']);
                });
            })->when(isset($this->filters), function ($query){
                $query->where(function ($query) {
                    $filterItemData = $this->itemService()->getFilterItemData();

                    $this->filterCallback($query, $this->filters, $filterItemData);
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(self::PER_PAGE);

        return $items;
    }

    private function itemService(): ItemService
    {
        return new ItemService();
    }
}
