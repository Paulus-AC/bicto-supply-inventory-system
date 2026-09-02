<?php

namespace App\Livewire\Items;

use App\Livewire\BaseComponent;
use App\Models\Item;
use App\Services\ItemService;

class View extends BaseComponent
{
    public int $id;

    private ItemService $itemService;

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
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $items = $this->itemService->getItem($this->id);

        return view('livewire.items.view', [
            'items' => $items
        ]);
    }
}
