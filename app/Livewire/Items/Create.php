<?php

namespace App\Livewire\Items;

use App\Livewire\Forms\CreateItemForm;
use App\Models\Category;
use App\Models\Unit;
use App\Livewire\BaseComponent;
use App\Models\Item;
use Exception;
use Illuminate\Support\Facades\DB;

class Create extends BaseComponent
{
    public CreateItemForm $form;

    public function render()
    {
        return view('livewire.items.create', [
            'categories' => $this->fetchCategories(),
            'units' => $this->fetchUnits()
        ]);
    }

    public function createItem(): void
    {
        $this->form->validate();

        DB::beginTransaction();
        try {

            Item::create(
                $this->form->payload()
            );

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

    private function fetchCategories()
    {
        return Category::where('status', 1)->get();
    }

    private function fetchUnits()
    {
        return Unit::where('status', 1)->get();
    }
}
