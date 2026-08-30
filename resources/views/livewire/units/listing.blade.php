<section class="w-full">
    @include('partials.section-heading', ['heading' => __('Manage Units')])

    <x-common.layout>
        <x-common.table-toolbar>

            <flux:modal.trigger name="create-unit">
                <flux:button variant="primary" size="sm" icon="plus-circle" :loading="false">
                    Add Unit
                </flux:button>
            </flux:modal.trigger>

        </x-common.table-toolbar>
        <div
            class="mt-2 w-full rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">

            <flux:table :paginate="$units">
                <flux:table.columns>
                    <flux:table.column align="center">{{ __('ID') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Unit Name') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Status') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Actions') }}</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @forelse ($units as $unit)
                        <flux:table.row :key="$unit->id">
                            <flux:table.cell align="center">{{ $unit->id }}</flux:table.cell>
                            <flux:table.cell align="center">{{ $unit->name }}</flux:table.cell>
                            <flux:table.cell align="center">
                                <flux:badge color="{{ $unit->status === 1 ? 'green' : 'red' }}">
                                    {{ $unit->status === 1 ? __('Active') : __('Inactive') }}
                                </flux:badge>
                            </flux:table.cell>
                            <flux:table.cell align="center">
                                <flux:modal.trigger name="update-unit">
                                    <flux:button variant="primary" size="sm" icon="pencil" :loading="false"
                                        wire:click="$dispatch('update-unit', { unitId: {{ $unit->id }} })">
                                    </flux:button>
                                </flux:modal.trigger>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="4" class="text-center py-4">
                                {{ __('No units found.') }}
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>
        </div>

        <livewire:units.create />
        <livewire:units.update />
    </x-common.layout>
</section>