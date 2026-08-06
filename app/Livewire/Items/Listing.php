<?php

namespace App\Livewire\Items;

use App\Livewire\BaseComponent;
use Livewire\Attributes\On;
use App\Models\Item;

class Listing extends BaseComponent
{
    public function render()
    {
        $items = $this->fetchItemListings();

        return view('livewire.items.listing', [
            'items' => $items
        ]);
    }

    #[On('item-created')]
    // #[On('item-updated')]
    public function refreshItems(): void
    {

    }

    private function fetchItemListings()
    {
        $items = Item::orderBy('status', 'desc')
            ->orderBy('id', 'asc')
            ->paginate(self::PER_PAGE);

        return $items;
    }
}
