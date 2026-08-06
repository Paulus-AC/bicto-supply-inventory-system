<section class="w-full">
    @include('partials.section-heading', ['heading' => __('Manage Items')])

    <x-common.layout>
        <x-common.table-toolbar>

            <flux:modal.trigger name="create-item">
                <flux:button variant="primary" size="sm" icon="plus-circle" :loading="false">
                    Add Item
                </flux:button>
            </flux:modal.trigger>

        </x-common.table-toolbar>

        <div
            class="mt-2 w-full rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">

            <flux:table :paginate="$items">
                <flux:table.columns>
                    <flux:table.column align="center">{{ __('ID') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Item Name') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Category') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Unit') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Balance') }}</flux:table.column>
                    {{-- <flux:table.column align="center">{{ __('Status') }}</flux:table.column> --}}
                    <flux:table.column align="center">{{ __('Actions') }}</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @forelse ($items as $item)
                        <flux:table.row :key="$item->id">
                            <flux:table.cell align="center">{{ $item->id }}</flux:table.cell>
                            <flux:table.cell align="center">{{ $item->name }}</flux:table.cell>
                            <flux:table.cell align="center">{{ $item->category->name }}</flux:table.cell>
                            <flux:table.cell align="center">{{ $item->unit->name }}</flux:table.cell>
                            <flux:table.cell align="center">
                                <flux:badge
                                   variant="solid" color="{{ $item->balance === 0 ? 'red' : ($item->balance < 5 ? 'amber' : 'green') }}">
                                    {{ $item->balance }}
                                </flux:badge>
                            </flux:table.cell>
                            {{-- <flux:table.cell align="center">
                                <flux:badge color="{{ $item->status === 1 ? 'green' : 'red' }}">
                                    {{ $item->status === 1 ? __('Active') : __('Inactive') }}
                                </flux:badge>
                            </flux:table.cell> --}}
                            <flux:table.cell align="center">
                                <flux:button variant="primary" size="sm" icon="eye" :loading="false"></flux:button>
                                <flux:button variant="primary" size="sm" icon="pencil" :loading="false"></flux:button>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="7" align="center">
                                {{ __('No items found.') }}
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>
        </div>

        <livewire:items.create />

    </x-common.layout>
</section>