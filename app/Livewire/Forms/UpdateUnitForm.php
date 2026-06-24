<?php

namespace App\Livewire\Forms;

use App\Models\Unit;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UpdateUnitForm extends Form
{
    public int $unit_id = 0;
    public string $name = '';
    public int $status = 0;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('units', 'name')->ignore($this->unit_id),
            ],
            'status' => [
                'required',
                'integer',
            ],
        ];
    }

    public function fillFromUnit(Unit $unit): void
    {
        $this->fill([
            'unit_id' => $unit->id,
            'name' => $unit->name,
            'status' => $unit->status,
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
