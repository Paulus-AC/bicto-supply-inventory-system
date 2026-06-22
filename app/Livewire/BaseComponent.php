<?php

namespace App\Livewire;

use Exception;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseComponent extends Component
{
    use WithPagination;

    public const PER_PAGE = 10;

    public string $search = '';

    /**
     * Reset pagination whenever search changes.
     */
    public function updatedSearch(): void
    {
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
     * Reset search and pagination.
     */
    protected function clearFilters(): void
    {
        $this->search = '';

        $this->resetPage();
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
}
