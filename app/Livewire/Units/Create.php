<?php

namespace App\Livewire\Units;

use Exception;
use App\Livewire\BaseComponent;
use Illuminate\Support\Facades\DB;
use App\Livewire\Forms\CreateUnitForm;
use App\Models\Unit;

class Create extends BaseComponent
{
    public CreateUnitForm $form;

    public function createUnit(): void
    {
        $this->form->validate();

        DB::beginTransaction();
        try {

            Unit::create(
                $this->form->payload()
            );

            $this->form->reset();

            $this->success(
                message: 'Unit created successfully.',
                modal: 'create-unit',
                event: 'unit-created'
            );
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            $this->reportException($exception);

            $this->error(
                message: 'Failed to create unit.',
                modal: 'create-unit'
            );
        }
    }

    public function render()
    {
        return view('livewire.units.create');
    }
}
