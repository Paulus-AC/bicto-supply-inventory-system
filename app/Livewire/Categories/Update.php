<?php

namespace App\Livewire\Categories;

use App\Livewire\Forms\UpdateCategoryForm;
use Livewire\Attributes\On;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Livewire\BaseComponent;

class Update extends BaseComponent
{
    public UpdateCategoryForm $form;

    #[On('update-category')]
    public function open(int $categoryId): void
    {
        $category = Category::findOrFail($categoryId);

        $this->form->fillFromCategory($category);
    }

    public function updateCategory(): void
    {
        $this->form->validate();

        $category = Category::findOrFail($this->form->category_id);

        DB::beginTransaction();
        try {
            $category->update(
                $this->form->payload()
            );

            $this->form->reset();

            $this->success(
                message: 'Category successfully updated.',
                modal: 'update-category',
                event: 'category-updated'
            );

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->reportException($exception);
            $this->error(
                message: 'Failed to update category.',
                modal: 'update-category'
            );
        }
    }

    public function render()
    {
        return view('livewire.categories.update');
    }
}
