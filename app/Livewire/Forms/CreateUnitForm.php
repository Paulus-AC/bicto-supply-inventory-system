<?php

namespace App\Livewire\Forms;

use App\Models\Unit;
use Illuminate\Validation\Rule;
use Livewire\Form;

class CreateUnitForm extends Form
{
    public string $name = '';

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Unit::class)
            ],
        ];
    }

    public function payload(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
