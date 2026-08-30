<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Form;

class CreateCategoryForm extends Form
{
    public string $name = '';

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Category::class),
            ]
        ];
    }

    public function payload(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
