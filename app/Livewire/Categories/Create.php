<?php

namespace App\Livewire\Categories;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\CreateCategoryForm;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;

class Create extends BaseComponent
{
    public CreateCategoryForm $form;

    public function createCategory(): void
    {
        $this->form->validate();

        DB::beginTransaction();
        try {

            Category::create(
                $this->form->payload()
            );

            $this->form->reset();

            $this->success(
                message: 'Category created successfully.',
                modal: 'create-category',
                event: 'category-created'
            );
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            $this->reportException($exception);

            $this->error(
                message: 'Failed to create category.',
                modal: 'create-category'
            );
        }
    }

    public function render()
    {
        return view('livewire.categories.create');
    }
}
