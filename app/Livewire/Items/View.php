<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Livewire\Component;

class View extends Component
{
    public int $id;
    
    public function render()
    {
        $items = $this->getItems($this->id);
        return view('livewire.items.view', [
            'items' => $items
        ]);
    }

    private function getItems(int $id)
    {
        $item = Item::findOrFail($id);

        return $item;
    }
}
