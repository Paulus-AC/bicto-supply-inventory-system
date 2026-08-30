<?php

namespace App\Livewire\Units;

use App\Models\Unit;
use Livewire\Attributes\On;
use App\Livewire\BaseComponent;

class Listing extends BaseComponent
{
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

    private function fetchUnitListings()
    {
        $units = Unit::search($this->search)
            ->orderBy('status', 'desc')
            ->orderBy('id', 'asc')
            ->paginate(self::PER_PAGE);

        return $units;
    }
}
