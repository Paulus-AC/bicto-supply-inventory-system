<?php

namespace App\Livewire\Items;

use App\Livewire\Forms\UpdateItemForm;
use Livewire\Attributes\On;
use App\Livewire\BaseComponent;
use App\Services\ItemService;
use Exception;
use Illuminate\Support\Facades\DB;

class Update extends BaseComponent
{
    public UpdateItemForm $form;
    
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

    public function render()
    {
        $units = $this->itemService->fetchItemUnits();
        $categories = $this->itemService->fetchItemCategories();

        return view('livewire.items.update', [
            'units' => $units,
            'categories' => $categories,
        ]);
    }

    #[On('update-item')]
    public function open(int $itemId): void
    {
        $this->form->reset();

        $item = $this->itemService->getItem($itemId);

        $this->form->fillFromItem($item);
    }

    public function updateItem(): void
    {
        $this->form->validate();

        $item = $this->itemService->getItem($this->form->item_id);

        DB::beginTransaction();
        try {

            $this->itemService->updateItem($item, $this->form->payload());

            $this->form->reset();

            $this->success(
                message: 'Item successfully updated.',
                modal: 'update-item',
                event: 'item-updated'
            );

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->reportException($exception);
            $this->error(
                message: 'Failed to update item.',
                modal: 'update-item'
            );
        }
    }
}
