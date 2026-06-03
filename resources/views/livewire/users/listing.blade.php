<section class="w-full">
    @include('partials.users-heading')

    <x-users.layout>
        <div class="flex flex-col gap-3 justify-end sm:flex-row sm:items-center">

            <div class="w-full sm:w-56">
                <flux:input wire:model.live.debounce.300ms='search' class="w-full" icon="magnifying-glass"
                    placeholder="Search..." />
            </div>

            <flux:modal.trigger name="create-user">
                <flux:button variant="primary" size="sm">
                    {{ __('Add New User') }}
                </flux:button>
            </flux:modal.trigger>
        </div>

        <div
            class="mt-6 w-full rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
            <flux:table :paginate="$users">
                <flux:table.columns>
                    <flux:table.column>{{ __('Employee ID') }}</flux:table.column>
                    <flux:table.column>{{ __('Full Name') }}</flux:table.column>
                    <flux:table.column>{{ __('Email') }}</flux:table.column>
                    <flux:table.column>{{ __('Role') }}</flux:table.column>
                    <flux:table.column>{{ __('Status') }}</flux:table.column>
                    <flux:table.column>{{ __('Actions') }}</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @foreach ($users as $user)
                        <flux:table.row :key="$user->id">
                            <flux:table.cell>{{ $user->employee_id }}</flux:table.cell>
                            <flux:table.cell>{{ $user->name }}</flux:table.cell>
                            <flux:table.cell>{{ $user->email }}</flux:table.cell>
                            <flux:table.cell>
                                <flux:badge color="blue">
                                    {{ $user->roleName() }}
                                </flux:badge>
                            </flux:table.cell>
                            <flux:table.cell>
                                <flux:badge color="{{ $user->status === 1 ? 'green' : 'red' }}">
                                    {{ $user->status === 1 ? __('Active') : __('Inactive') }}
                                </flux:badge>
                            </flux:table.cell>
                            <flux:table.cell>
                                <div class="flex gap-2">
                                    <flux:button variant="primary" size="sm">
                                        Update
                                    </flux:button>

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
                    @endforeach

                    @if ($users->isEmpty())
                        <flux:table.row>
                            <flux:table.cell colspan="6" class="text-center py-4">
                                {{ __('No users found.') }}
                            </flux:table.cell>
                        </flux:table.row>
                    @endif
                </flux:table.rows>
            </flux:table>
        </div>

        <livewire:users.create />
        <livewire:common.delete-confirmation />
    </x-users.layout>
</section>