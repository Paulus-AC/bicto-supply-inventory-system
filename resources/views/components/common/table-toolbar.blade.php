<div class="flex flex-col gap-3 justify-end sm:flex-row sm:items-center">

    <div class="w-full sm:w-56">
        <flux:input
            wire:model.live.debounce.300ms="search"
            class="w-full"
            icon="magnifying-glass"
            placeholder="Search..."
        />
    </div>

    <div>
        {{ $slot }}
    </div>

</div>