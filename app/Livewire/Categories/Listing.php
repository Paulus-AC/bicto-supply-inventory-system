<?php

namespace App\Livewire\Categories;

use App\Livewire\BaseComponent;
use Livewire\Attributes\On;
use App\Models\Category;
use App\Services\CategoryService;

class Listing extends BaseComponent
{
    private CategoryService $categoryService;

    /**
     * Boot the component with the Category Service
     * 
     * @param CategoryService $categoryService
     */
    public function boot(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

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

    /**
     * Fetch the category listings based on the search term
     * 
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function fetchCategoryListings()
    {
        $paginatedCategories = $this->categoryService->getCategoryListings($this->search)
            ->paginate(self::PER_PAGE);

        return $paginatedCategories;
    }
}