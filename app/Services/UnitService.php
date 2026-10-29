<?php

namespace App\Services;

use App\Models\Unit;

class UnitService
{
    /**
     * Get the unit listings based on search.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getUnitListings(string $search)
    {
        $units = Unit::when(isset($search) && ! empty($search), function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                query_search($query, $search, ['name']);
            });
        })->orderBy('status', 'desc')
        ->orderBy('id', 'asc');

        return $units;
    }

    /**
     * Create a new unit with the given payload.
     * @param array $payload
     * @return Unit
     */
    public function createUnit(array $payload): Unit
    {
        return Unit::create($payload);
        
    }

    /**
     * Update the given unit with the provided payload.
     *
     * @param Unit $unit
     * @param array $payload
     * @return bool
     */
    public function updateUnit(Unit $unit, array $payload): bool
    {
        return $unit->update($payload);
    }

    /**
     * Get a specific unit by its ID.
     *
     * @param int $unitId
     * @return Unit|null
     */
    public function getUnit($unitId): ?Unit
    {
        return Unit::findOrFail($unitId);
    }
}
