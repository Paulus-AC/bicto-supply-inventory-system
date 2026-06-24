<section class="w-full">
    @include('partials.section-heading', ['heading' => __('Manage Categories')])

    <x-common.layout>
        <x-common.table-toolbar>

            <flux:modal.trigger name="create-category">
                <flux:button variant="primary" size="sm" icon="plus-circle" :loading="false">
                    Add Category
                </flux:button>
            </flux:modal.trigger>

        </x-common.table-toolbar>

        <div
            class="mt-2 w-full rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">

            <flux:table :paginate="$categories">
                <flux:table.columns>
                    <flux:table.column align="center">{{ __('ID') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Category Name') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Items') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Status') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Actions') }}</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @forelse($categories as $category)
                        <flux:table.row :key="$category->id">
                            <flux:table.cell align="center">{{ $category->id }}</flux:table.cell>
                            <flux:table.cell align="center">{{ $category->name }}</flux:table.cell>
                            <flux:table.cell align="center">{{ $category->item_count ?? 0 }}</flux:table.cell>
                            <flux:table.cell align="center">
                                <flux:badge color="{{ $category->status === 1 ? 'green' : 'red' }}">
                                    {{ $category->status === 1 ? __('Active') : __('Inactive') }}
                                </flux:badge>
                            </flux:table.cell>
                            <flux:table.cell align="center">
                                <flux:modal.trigger name="update-category">
                                    <flux:button variant="primary" size="sm" icon="pencil" :loading="false"
                                        wire:click="$dispatch('update-category', { categoryId: {{ $category->id }} })">
                                    </flux:button>
                                </flux:modal.trigger>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="4" class="text-center py-4">
                                {{ __('No categories found.') }}
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>
        </div>

        <livewire:categories.create />
        <livewire:categories.update />

    </x-common.layout>
</section>