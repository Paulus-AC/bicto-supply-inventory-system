<?php

namespace App\Livewire\Units;

use Livewire\Attributes\On;
use App\Livewire\BaseComponent;
use App\Services\UnitService;

class Listing extends BaseComponent
{
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
        $units = $this->fetchUnitListings();
        
        return view('livewire.units.listing', [
            'units' => $units
        ]);
    }

    #[On('unit-created')]
    #[On('unit-updated')]
    public function refreshUnits(): void
    {

    }

    /**
     * Fetch the unit listings with pagination.
     * 
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function fetchUnitListings()
    {
        $paginatedUnits = $this->unitService->getUnitListings($this->search)
            ->paginate(self::PER_PAGE);

        return $paginatedUnits;
    }
}
