<?php

namespace App\Livewire\Units;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\UpdateUnitForm;
use Livewire\Attributes\On;
use Exception;
use Illuminate\Support\Facades\DB;

use App\Models\Unit;

class Update extends BaseComponent
{
    public UpdateUnitForm $form;

    #[On('update-unit')]
    public function open(int $unitId): void
    {
        $unit = Unit::findOrFail($unitId);

        $this->form->fillFromUnit($unit);
    }

    public function updateUnit(): void
    {
        $this->form->validate();

        $unit = Unit::findOrFail($this->form->unit_id);

        DB::beginTransaction();
        try {
        $unit->update(
            $this->form->payload()
        );

        $this->form->reset();

        $this->success(
            message: 'Unit successfully updated.',
            modal: 'update-unit',
            event: 'unit-updated'
        );
        DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->reportException($exception);
            $this->error(
                message: 'Failed to update unit.',
                modal: 'update-unit'
            );
        }
    }

    public function render()
    {
        return view('livewire.units.update');
    }
}
