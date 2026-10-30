<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Get the category listings based on search.
     * 
     * @param string $search
     * @return \Illuminate\Database\Query\Builder
     */
    public function getCategoryListings(string $search)
    {
        $categories = Category::withCount('items')
            ->when(isset($search) && ! empty($search), function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    query_search($query, $search, ['name']);
                });
            })
            ->orderBy('status', 'desc')
            ->orderBy('name', 'asc');

        return $categories;
    }

    /**
     * Create a new category with the given payload.
     * 
     * @param array $payload
     * @return Category
     */
    public function createCategory(array $payload): Category
    {
        return Category::create($payload);
    }

    /**
     * Get a specific category by its ID.
     * 
     * @param int $categoryId
     * @return Category|null
     */
    public function getCategory(int $categoryId): ?Category
    {
        return Category::findOrFail($categoryId);
    }

    /**
     * Update the given category with the provided payload.
     * 
     * @param Category $category
     * @param array $payload
     * @return bool
     */
    public function updateCategory(Category $category, array $payload): bool
    {
        return $category->update($payload);
    }
}