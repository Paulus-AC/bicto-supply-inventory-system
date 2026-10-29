<?php

namespace App\Livewire\Units;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\UpdateUnitForm;
use Livewire\Attributes\On;
use Exception;
use Illuminate\Support\Facades\DB;

use App\Models\Unit;
use App\Services\UnitService;

class Update extends BaseComponent
{
    public UpdateUnitForm $form;
    private UnitService $unitService;

    /**
     * Boot the component with the UnitService.
     *
     * @param UnitService $unitService
     */
    public function boot(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function render()
    {
        return view('livewire.units.update');
    }

    #[On('update-unit')]
    public function open(int $unitId): void
    {
        $this->form->reset();

        $unit = $this->unitService->getUnit($unitId);

        $this->form->fillFromUnit($unit);
    }

    public function updateUnit(): void
    {
        $this->form->validate();

        $unit = $this->unitService->getUnit($this->form->unit_id);

        DB::beginTransaction();
        try {
        
        $this->unitService->updateUnit($unit, $this->form->payload());

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
}
