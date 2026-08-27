<?php

namespace App\Livewire;

use App\Helpers\QueryHelper;
use Exception;
use Flux\Flux;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseComponent extends Component
{
    use WithPagination;

    public const PER_PAGE = 10;

    public string $search = '';

    public string $sortBy = 'id';

    public string $sortDirection = 'desc';

    public array $filters = [];

    /**
     * Sort the given column.
     */
    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection =
                $this->sortDirection === 'asc'
                    ? 'desc'
                    : 'asc';

            return;
        }

        $this->sortBy = $column;
        $this->sortDirection = 'asc';

        $this->resetPage();
    }

    /**
     * Reset pagination whenever search changes.
     */
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Reset pagination whenever a filter changes.
     */
    public function updatedFilters(): void
    {
        $this->resetPage();
    }

    /**
     * Clear all filters and search.
     */
    public function clearFilters(): void
    {
        $this->search = '';

        $this->filters = [];

        $this->resetPage();
    }

    /**
     * Display a Flux toast notification.
     */
    protected function toast(
        string $message,
        string $variant = 'success'
    ): void {
        Flux::toast(
            text: $message,
            variant: $variant
        );
    }

    /**
     * Display success notification.
     */
    protected function success(
        string $message,
        ?string $modal = null,
        ?string $event = null
    ): void {
        if ($event) {
            $this->dispatch($event);
        }

        $this->toast(
            message: $message,
            variant: 'success'
        );

        $this->closeModal($modal);
    }

    /**
     * Display error notification.
     */
    protected function error(
        string $message = 'Unexpected error occurred. Please contact the administrator.',
        ?string $modal = null
    ): void {
        $this->toast(
            message: $message,
            variant: 'danger'
        );

        $this->closeModal($modal);
    }

    /**
     * Close a Flux modal.
     */
    protected function closeModal(?string $modal = null): void
    {
        if (filled($modal)) {
            Flux::modal($modal)->close();
        }
    }

    /**
     * Log exception details.
     */
    protected function reportException(
        Exception $exception,
        string $context = 'Livewire component exception'
    ): void {
        Log::error($context, [
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ]);
    }

    /**
     * Search callback for Eloquent queries.
     */
    protected function searchCallback(Builder $query, ?string $search = '', array $targets = []): Builder
    {
        return QueryHelper::searchCallback($query, $search, $targets);
    }

    /**
     * Apply filters to an Eloquent query.
     */
    protected function filterCallback(Builder $query, array $filters = [], array $definitions = []): Builder 
    {
        return QueryHelper::filterCallback($query, $filters, $definitions);
    }
}
