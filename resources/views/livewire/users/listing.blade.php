<section class="w-full">
    @include('partials.users-heading')

    <x-users.layout>
        <div class="flex flex-col gap-3 justify-end sm:flex-row sm:items-center">

            <div class="w-full sm:w-56">
                <flux:input wire:model.live.debounce.300ms='search' class="w-full" icon="magnifying-glass"
                    placeholder="Search..." />
            </div>

            <flux:modal.trigger name="create-user">
                <flux:button variant="primary" size="sm" icon="plus-circle" class="cursor-pointer">
                    {{ __('Add New User') }}
                </flux:button>
            </flux:modal.trigger>
        </div>

        <div
            class="mt-6 w-full rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
            <flux:table :paginate="$users">
                <flux:table.columns>
                    <flux:table.column align="center">{{ __('Employee ID') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Full Name') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Email') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Role') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Status') }}</flux:table.column>
                    <flux:table.column align="center">{{ __('Actions') }}</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @forelse ($users as $user)
                        <flux:table.row :key="$user->id">
                            <flux:table.cell align="center">{{ $user->employee_id }}</flux:table.cell>
                            <flux:table.cell align="center">{{ $user->name }}</flux:table.cell>
                            <flux:table.cell align="center">{{ $user->email }}</flux:table.cell>
                            <flux:table.cell align="center">
                                <flux:badge color="blue">
                                    {{ $user->roleName() }}
                                </flux:badge>
                            </flux:table.cell>
                            <flux:table.cell align="center">
                                <flux:badge color="{{ $user->status === 1 ? 'green' : 'red' }}">
                                    {{ $user->status === 1 ? __('Active') : __('Inactive') }}
                                </flux:badge>
                            </flux:table.cell>
                            <flux:table.cell align="center">
                                <div class="gap-2">
                                    <flux:modal.trigger name="update-user">
                                        <flux:button variant="primary" size="sm" wire:click="$dispatch('update-user', { userId: {{ $user->id }} })">
                                            Update
                                        </flux:button>
                                    </flux:modal.trigger>

                                    <flux:modal.trigger name="delete-confirmation-modal">
                                        <flux:button variant="danger" size="sm" wire:click="$dispatch('confirm-delete', 
                                                                { id: {{ $user->id }},
                                                                dispatchAction: 'delete-user',
                                                                modalName: 'delete-confirmation-modal',
                                                                heading: 'Delete User',
                                                                subheading: 'Are you sure you want to delete {{ $user->name }} account. This cannot be undone.' 
                                                                })">
                                            Delete
                                        </flux:button>
                                    </flux:modal.trigger>
                                </div>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="6" class="text-center py-4">
                                {{ __('No users found.') }}
                            </flux:table.cell>
                        </flux:table.row>

                    @endforelse
                </flux:table.rows>
            </flux:table>
        </div>

        <livewire:users.create />
        <livewire:users.update />
        <livewire:common.delete-confirmation />
    </x-users.layout>
</section>