<section class="w-full">
    @include('partials.section-heading', ['heading' => __('Manage Items')])

    <x-common.layout>
        <x-common.table-toolbar>

            <flux:dropdown keep-open>
                <flux:button icon:trailing="chevron-down">Options</flux:button>

                <flux:menu keep-open>
                    <flux:modal.trigger name="create-item">
                        <flux:menu.item icon="plus">Add Item</flux:menu.item>
                    </flux:modal.trigger>

                    <flux:menu.separator />

                    <flux:menu.submenu heading="Filter" keep-open>
                        <flux:menu.submenu heading="Stock">
                            <flux:menu.checkbox wire:model.live="filters.in_stock">In Stock</flux:menu.checkbox>
                            <flux:menu.checkbox wire:model.live="filters.out_of_stock">Out of Stock</flux:menu.checkbox>
                        </flux:menu.submenu>

                        <flux:menu.checkbox wire:model.live="filters.archived">Archived</flux:menu.checkbox>

                    </flux:menu.submenu>
                    <flux:menu.separator />

                    <flux:menu.item variant="danger" wire:click="clearFilters">Clear</flux:menu.item>
                </flux:menu>
            </flux:dropdown>

        </x-common.table-toolbar>

        <div
            class="w-full rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">

            <flux:table :paginate="$items">
                <flux:table.columns>
                    <flux:table.column align="center" sortable :sorted="$sortBy === 'id'" :direction="$sortDirection"
                        wire:click="sort('id')">{{ __('ID') }}
                    </flux:table.column>
                    <flux:table.column align="center" sortable :sorted="$sortBy === 'name'" :direction="$sortDirection"
                        wire:click="sort('name')">{{ __('Item Name') }}
                    </flux:table.column>
                    <flux:table.column align="center">{{ __('Category') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Unit') }}</flux:table.column>
                    <flux:table.column align="center" sortable :sorted="$sortBy === 'balance'"
                        :direction="$sortDirection" wire:click="sort('balance')">{{ __('In Stock') }}
                    </flux:table.column>
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
                                    color="{{ $item->balance === 0 ? 'red' : ($item->balance < 5 ? 'amber' : 'green') }}">
                                    {{ $item->balance }}
                                </flux:badge>
                            </flux:table.cell>
                            <flux:table.cell align="center">
                                <flux:button variant="primary" size="sm" icon="eye" :loading="false"
                                    :href="route('items.view', $item)"></flux:button>
                                <flux:modal.trigger name="update-item">
                                    <flux:button variant="primary" size="sm" icon="pencil" :loading="false"
                                        wire:click="$dispatch('update-item', { itemId: {{ $item->id }} })"></flux:button>
                                </flux:modal.trigger>
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
        <livewire:items.update />

    </x-common.layout>
</section>