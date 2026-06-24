<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UpdateCategoryForm extends Form
{
    public int $category_id = 0;
    public string $name = '';
    public int $status = 0;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($this->category_id),
            ],
            'status' => [
                'required',
                'integer',
            ],
        ];
    }

    public function fillFromCategory(Category $category): void
    {
        $this->fill([
            'category_id' => $category->id,
            'name' => $category->name,
            'status' => $category->status,
        ]);
    }

    public function payload(): array
    {
        return [
            'name' => $this->name,
            'status' => $this->status,
        ];
    }
}