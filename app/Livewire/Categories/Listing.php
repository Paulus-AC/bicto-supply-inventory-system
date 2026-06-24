<?php

namespace App\Livewire\Categories;

use App\Livewire\BaseComponent;
use Livewire\Attributes\On;
use App\Models\Category;

class Listing extends BaseComponent
{
    public function render()
    {
        $categories = $this->fetchCategoryListings();

        return view('livewire.categories.listing', [
            'categories' => $categories
        ]);
    }

    #[On('category-created')]
    #[On('category-updated')]
    public function refreshCategories(): void
    {

    }

    private function fetchCategoryListings()
    {
        $categories = Category::search($this->search)
            ->withCount('items')
            ->orderBy('status', 'desc')
            ->orderBy('name', 'asc')
            ->paginate(self::PER_PAGE);

        return $categories;
    }
}