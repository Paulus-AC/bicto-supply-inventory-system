<?php

namespace App\Livewire\Forms;

use App\Models\Item;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UpdateItemForm extends Form
{
    public ?int $item_id = null;
    public string $name = '';
    public ?int $category_id = null;
    public ?int $unit_id = null;
    public ?int $balance = null;
    public ?string $description = '';
    public int $status = 0;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Item::class, 'name')
                    ->ignore($this->item_id),
            ],

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'unit_id' => [
                'required',
                'exists:units,id',
            ],

            // 'balance' => [
            //     'required',
            //     'numeric',
            //     'min:0',
            // ],

            'description' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'integer',
            ],
        ];
    }

    public function fillFromItem(Item $item): void
    {
        $this->fill([
            'item_id' => $item->id,
            'name' => $item->name,
            'category_id' => $item->category_id,
            'unit_id' => $item->unit_id,
            'balance' => $item->balance,
            'description' => $item->description,
            'status' => $item->status,
        ]);
    }

    public function payload(): array
    {
        return [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'unit_id' => $this->unit_id,
            // 'balance' => $this->balance,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }

}
