<?php

namespace App\Livewire\Forms;

use App\Models\Item;
use Illuminate\Validation\Rule;
use Livewire\Form;

class CreateItemForm extends Form
{
    public string $name = '';

    public ?int $category_id = null;

    public ?int $unit_id = null;

    public ?int $balance = null;

    public string $description = '';

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Item::class),
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'unit_id' => [
                'required',
                'exists:units,id',
            ],
            'balance' => [
                'required',
                'numeric',
                'min:0',
            ],
            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    public function payload(): array
    {
        return [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'unit_id' => $this->unit_id,
            'balance' => $this->balance,
            'description' => $this->description,
        ];
    }
}
