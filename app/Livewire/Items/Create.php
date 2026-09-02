<?php

namespace App\Livewire\Items;

use App\Livewire\Forms\CreateItemForm;
use App\Services\ItemService;
use App\Livewire\BaseComponent;
use Exception;
use Illuminate\Support\Facades\DB;

class Create extends BaseComponent
{
    public CreateItemForm $form;

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

        return view('livewire.items.create', [
            'categories' => $categories,
            'units' => $units
        ]);
    }

    public function createItem(): void
    {
        $this->form->validate();

        DB::beginTransaction();
        try {

            $this->itemService->createItem($this->form->payload());

            $this->form->reset();

            $this->success(
                message: 'Item created successfully.',
                modal: 'create-item',
                event: 'item-created'
            );

            DB::commit();

        } catch (Exception $exception) {
            DB::rollBack();

            $this->reportException($exception);

            $this->error(
                message: 'Failed to create item.',
                modal: 'create-item'
            );
        }
    }
}
